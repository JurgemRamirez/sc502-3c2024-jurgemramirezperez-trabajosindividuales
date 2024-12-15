<?php
require "message_log.php";

$host = getenv('DB_HOST') !== false ? getenv('DB_HOST') : '127.0.0.1:33080';
$dbname = getenv('DB_NAME') !== false ? getenv('DB_NAME') : 'TODO_APP';
$user = getenv('DB_USER') !== false ? getenv('DB_USER') : 'root';
$password = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : 'adminfull';

try{

    $pdo = new PDO("mysql:host=$host;dbname=$dbname",$user,$password);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    logDebug("DB: Conexion Exitosa");


}catch(PDOException $e){
    logError($e -> getMessage());
    die("Error de conexion: " . $e -> getMessage());
}