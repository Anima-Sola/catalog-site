<?php

$dsn = 'mysql:dbname=catalog-site;host=localhost';
$user = 'root';
$password = '';

try {
    Object::$db = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Подключение к базе данных не удалось: ' . $e->getMessage();
    exit();
}
