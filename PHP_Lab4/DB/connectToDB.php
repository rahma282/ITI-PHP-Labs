<?php
require_once "../includes/utils.php";
require_once "../includes/DBConfig.php";


function connect_to_db(){
    $pdo=false;
    try{
        $dns = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT."";
        $pdo = new PDO($dns, DB_USER, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch (PDOException $e){
        die("Connection failed: " . $e->getMessage());
    }

    return $pdo;
}

connect_to_db();