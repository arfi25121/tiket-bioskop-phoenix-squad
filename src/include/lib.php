<?php
// display all error
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_name('AppSession_'.sha1($_SERVER['HTTP_HOST']));
session_start();

require __DIR__.'/config.php';

function custom_chunk($array, $maxRows) {
    $size = count($array);
    $columns = ceil($size / $maxRows);
    $lessOne = $columns - 1;
    $fullRows = $size - $lessOne * $maxRows;
    
    for ($i = 0; $i < $maxRows; ++$i) {
        $result[] = array_splice($array, 0, ($i < $fullRows ? $columns : $lessOne));
    }
    return $result;
}

/**
 * check session
 */
function check_session()
{
    if(!isset($_SESSION['id'])){
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header('Location: /login');
        exit;
    }elseif($_SESSION['sebagai'] ?? false and $_SESSION['sebagai'] == 'admin'){
        header('Location: /admin');
//         echo "<pre>
// Level: {$_SESSION['sebagai']}
// Anda tidak boleh mengakses halaman ini!
// Halaman Ini Diperuntukan hanya untuk user

// Mengalihkan halaman dalam 7 detik...
//     </pre>
//     <meta http-equiv=\"refresh\" content=\"7; url=/admin/\">";
    exit;
    }
}

/**
 * Check Session as Admin
 */
function check_session_admin()
{
    if(!isset($_SESSION['id']) or $_SESSION['sebagai'] != 'admin'){
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header('Location: /login');
        exit;
    }
}

/**
 * check apakah pembelian_tiket sudah di bayar atau tidak
 */
function check_pembelian_tiket($id){
    global $db;
    $q = $db->prepare("SELECT * FROM `pembelian_tiket` where id = :id");
    $q->execute([
        'id' => $id
    ]);
    $row = $q->fetch();
    return $row['status'] ?? 0;
}

/**
 * Parameter rquired:
 */
function parameter_must_exist($name, $type='mixed'){
    if($type == 'mixed'){
        if(!isset($_REQUEST[$name])){
            exit("Parameter \"$name\" must exist");
        }
    }
}

/**
 * random string by length
 */
function random_string($length){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}