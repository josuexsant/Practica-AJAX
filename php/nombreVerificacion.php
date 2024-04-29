<?php
include 'conexionMysql.php';

if ( isset( $_POST[ 'nombre' ] ) ) {
    $nombre = $_POST[ 'nombre' ];

    $sql = "SELECT * FROM jugadores WHERE nombre = :nombre";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->execute();

    if ( $stmt->rowCount() > 0 ) {
        echo 200;
        // Si el nombre existe en la base de datos
    } else {
        echo 404;
        // Si el nombre no existe en la base de datos
    }
} else {
    echo 404;
}
?>

