<?php

$host = '127.0.0.1';
$dbname = 'LuxuryWatchesDB';
$username = 'root';
$password = '';


try {
    $pdo = new PDO("mysql:host=$host; dbname=$dbname; charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if(basename($_SERVER["PHP_SELF"]) == "bdForm.php") {
        echo "Подключение успешно!";}
}
catch (PDOException $e) {  
    die("Ошибка подключения: ". $e->getMessage());
}

?>