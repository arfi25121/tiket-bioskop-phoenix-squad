<?php
header('Content-Type: application/json');

require './include/lib.php';
$data = [];
$data['status'] = '200';
if($_GET['order'] ?? false and $_GET['order'] == 'ticket'){
    $kursi = $_POST['kursi'];
    $id_film = $_POST['id_film'];
    $id_jadwal = $_POST['id_jadwal'];
    $jam = $_POST['jam'];
    $tanggal = $_POST['tanggal'];
    $kursi_array = explode(',', $kursi);
    // print_r($kursi_array);

    $data_jadwal = $db->prepare('select * from jadwal_waktu where id_jadwal = :id_jadwal and jam=:jam and tanggal=:tanggal');
    $data_jadwal->execute([
        'id_jadwal' => $id_jadwal,
        'jam' => $jam,
        'tanggal' => $tanggal
    ]);
    $data_jadwal = $data_jadwal->fetch();

    $tgl_tayang = $data_jadwal['tanggal'];

    $q = $db->prepare("SELECT * FROM `film` where id=:id_film");
    $q->execute(['id_film'=>$id_film]);
    $row = $q->fetch();
    $harga_per_tiket = $row['harga_tiket'];
    $judul_film = $row['judul'];
    $durasi_film = $row['durasi'];

    $q = $db->prepare("INSERT INTO pembelian_tiket values(null,:id_jadwal,:id_user,Null, :total_harga, :tanggal_tayang, :jam, $now, :judul_film, :durasi_film, :harga_per_tiket)");
    $q->execute([
        'id_jadwal' => $id_jadwal,
        'id_user' => $_SESSION['id'],
        'total_harga' => $harga_per_tiket * count($kursi_array), //harga per tiket * jumlah tiket
        'tanggal_tayang'=>$tgl_tayang,
        'jam' => $jam,
        'judul_film' => $judul_film,
        'durasi_film' => $durasi_film,
        'harga_per_tiket' => $harga_per_tiket
    ]);
    $id_pembelian = $db->lastInsertId();
    // echo "ID Pembelian: $id_pembelian";
    $data['id_pembelian'] = $id_pembelian;
    
    foreach($kursi_array as $kursi){ //loop untuk setiap kursi yang dipesan
        $q = $db->prepare("INSERT INTO jadwal_kursi values(NULL,:id_jadwal,:id_pembelian,:no_kursi, :userid, :jam)");
        $q->execute([ //menginsert bahwa kursi ini dipesan oleh user
            'id_jadwal' => $id_jadwal,
            'id_pembelian' => $id_pembelian,
            'no_kursi' => $kursi,
            'userid' => $_SESSION['id'],
            'jam' => $jam
        ]);
    }
}else if($_GET['count']??false and  $_GET['count'] == 'visitor'){
    if ($_GET['js']??false and $_GET['js'] == 'source') {
        header('content-type: text/javascript;charset=UTF-8');
        $urlz = str_replace('&js=source', '', $_SERVER['REQUEST_URI']);
        echo <<<EOD
var http93=new XMLHttpRequest();
var url93='$urlz';
var params93 = 'd='+btoa(location.pathname);
http93.open('POST',url93,true);
http93.setRequestHeader('Content-type','application/x-www-form-urlencoded');
http93.onreadystatechange=function(){}
http93.send(params93);
EOD;
        exit;
    }

    $id = $db->query('select * from visitor_counter where tanggal = CURDATE()')->fetch();
    $tmp = $id;
    if(!$id){
        $q = $db->prepare("INSERT INTO visitor_counter values(null,CURDATE(),0)");
        $q->execute();
        $id = $db->query('select * from visitor_counter where tanggal = CURDATE()')->fetch();
        $tmp = $id;
        $id = $id['id'];
    }else{
        $id = $id['id'];
    }
    $q = $db->prepare("UPDATE visitor_counter SET total = total + 1 WHERE id = :id");
    $q->execute(['id'=>$id]);
    
    $data['id_hash'] = sha1($id);
    $data['total_hash'] = sha1($tmp['total']);
}

echo json_encode($data, JSON_PRETTY_PRINT);