<?php

include 'conexion.php';
session_start();

if(isset($_SESSION['usuario_id']) && isset($_GET['casaId'])) {

    $casaId = $_GET['casaId'];
    $query = "SELECT * FROM Sala WHERE casa_id = ?";
    $stmt = mysqli_prepare($conection, $query);
    mysqli_stmt_bind_param($stmt, "i", $casaId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $queryNombreCasa = "SELECT nombre_casa FROM Casa WHERE casa_id = ?";
    $stmtNombreCasa = mysqli_prepare($conection, $queryNombreCasa);
    mysqli_stmt_bind_param($stmtNombreCasa, "i", $casaId);
    mysqli_stmt_execute($stmtNombreCasa);
    $resultNombreCasa = mysqli_stmt_get_result($stmtNombreCasa);
    $nombreCasa = mysqli_fetch_assoc($resultNombreCasa)['nombre_casa'];

    $zonas = array();
    while($fila = mysqli_fetch_assoc($result)) {
        $zonas[] = $fila;
    }
    echo json_encode(array('nombreCasa' => $nombreCasa, 'zonas' => $zonas));
} else {
    echo json_encode(array('error' => 'Acceso no autorizado'));
}
mysqli_close($conection);
?>
