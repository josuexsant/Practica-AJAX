<?php
include 'conexionMysql.php';

$nombre = isset( $_POST[ 'nombre' ] ) ? $_POST[ 'nombre' ] : 'Anónimo';

// Obtener el ID del jugador
$sql = 'SELECT id FROM jugadores WHERE nombre = :nombre';
$stmt = $db->prepare( $sql );
$stmt->bindParam( ':nombre', $nombre );
$stmt->execute();

$idJugador = null;
if ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
    $idJugador = $row[ 'id' ];
}

$sql = 'SELECT * FROM score WHERE jugador = :idJugador ORDER BY puntaje DESC';
$stmt = $db->prepare( $sql );
$stmt->bindParam( ':idJugador', $idJugador );
// Obtener $idJugador de la parte B
$stmt->execute();

$ganancias = array();
while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
    $ganancias[] = $row;
}

header( 'Content-Type: application/json' );
echo json_encode( $ganancias );
?>
