<?php
 //setteo
 $host = 'localhost';
  $user = 'root';
  $password = '';
  $database = 'tragamonedas';

  try {
    $db = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }
?>