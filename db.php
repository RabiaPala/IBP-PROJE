<?php
// Veritabanı bağlantısını sağlayan dosya.
$host = 'localhost';
$db   = 'car_rental_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
   $pdo = new PDO("mysql:host=localhost;dbname=car_rental_db;charset=utf8", "kullanici_adi", "şifre");
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

// Açıklama: Bu dosya, PDO ile güvenli MySQL bağlantısı kurar. Tüm sorgular için $pdo nesnesi kullanılır.
