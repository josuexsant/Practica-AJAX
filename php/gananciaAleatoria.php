<?php
sleep(5);
$xmlData = file_get_contents('php://input');
$xml = simplexml_load_string($xmlData);

$nombre = isset($xml->nombre) ? (string)$xml->nombre : 'Anónimo';
$apellido = isset($xml->apellido) ? (string)$xml->apellido : '';

$gananciaMaxima = rand(0, 100);

echo 'Felicidades Sr. ' . $nombre . ' ' . $apellido . ', has ganado $' . $gananciaMaxima . ' pesos';
?>
