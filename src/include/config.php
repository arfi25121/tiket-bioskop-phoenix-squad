<?php
//Database connection
$dbhost = 'localhost';//"app-mariadb";
$dbname = 'bioskop';//"app_db";
$dbuser = 'pausi';//"app_user";
$dbpass = 'pausi';//"app_pass";

// using mysql
// $db = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass);

// using sqlite3
$db = new PDO("sqlite:".__DIR__."/../../database.db");
$database_type = 'sqlite'; // sqlite/mysql

// set time zone
date_default_timezone_set("Asia/Jakarta");

$title = "BIOSKOP XXI";
$app_name = $title;

$total_kursi = 80; //total kursi dalam bioskop
$film_image_path = '/static/image_films/'; //lokasi directory image film
$film_image = $_SERVER['DOCUMENT_ROOT'].$film_image_path; //lokasi directory gambar film
if($_REQUEST['logout'] ?? NULL){
    session_destroy();
    header('Location: /login');
    exit;
}

if($database_type == 'sqlite'){
    // query untuk database sqlite
    $now = "date('now')";
}else{
    $now = 'now()';
}