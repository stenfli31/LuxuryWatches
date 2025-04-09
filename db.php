<?php

$host = '127.0.0.1';
$dbname = 'LuxuryWatchesShop';
$username = 'root';
$password = '';


try {
    $pdo = new PDO("mysql:host=$host; dbname=$dbname; charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Подключение успешно!";
}
catch (PDOException $e) {  
    die("Ошибка подключения: ". $e->getMessage());
}

?>