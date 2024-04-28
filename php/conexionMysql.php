<?php
//creamos la conexion a la base de datos
$host = 'localhost';
$database = 'tragamonedas';
$user = 'root';
$password = '';

try {
    $db = new PDO( "mysql:host={$host};dbname={$database}", $user, $password );
} catch ( PDOException $e ) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}
?>