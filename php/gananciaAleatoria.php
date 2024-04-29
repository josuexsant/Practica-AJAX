<?php
include 'conexionMysql.php';
date_default_timezone_set('America/Mexico_City');

sleep(5);
$xmlData = file_get_contents('php://input');
$xml = simplexml_load_string($xmlData);

$nombre = isset($xml->nombre) ? (string)$xml->nombre : 'Anónimo';

// Obtener el ID del jugador
$sql = 'SELECT id FROM jugadores WHERE nombre = :nombre';
$stmt = $db->prepare($sql);
$stmt->bindParam(':nombre', $nombre);
$stmt->execute();

$idJugador = null;
if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $idJugador = $row['id'];
}

if ($idJugador !== null) {
    $gananciaMaxima = rand(0, 100);
    $fechaHora = date('Y-m-d H:i:s'); // Obtener la fecha y hora actual

    echo 'Felicidades Sr. ' . $nombre . ', has ganado $' . $gananciaMaxima . ' pesos';

    // Insertar el puntaje en la tabla score
    $sqlInsert = 'INSERT INTO score (jugador, puntaje, fecha) VALUES (:idJugador, :gananciaMaxima, :fecha)';
    $stmtInsert = $db->prepare($sqlInsert);
    $stmtInsert->bindParam(':idJugador', $idJugador);
    $stmtInsert->bindParam(':gananciaMaxima', $gananciaMaxima);
    $stmtInsert->bindParam(':fecha', $fechaHora);

    if ($stmtInsert->execute()) {
        echo ', puntaje guardado.';
    } else {
        echo 'Error al insertar el puntaje: ' . $stmtInsert->errorInfo()[2];
    }
} else {
    echo 'Jugador no encontrado';
}
?>
