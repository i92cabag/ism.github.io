<?php

include 'conexion.php';
session_start();

if(isset($_SESSION['usuario_id']) && isset($_GET['salaId'])) {

    $usuarioId = $_SESSION['usuario_id'];
    $salaId = $_GET['salaId'];

    $queryInfoSala = "SELECT Sala.nombre_sala, Casa.nombre_casa FROM Sala INNER JOIN Casa ON Sala.casa_id = Casa.casa_id WHERE Sala.sala_id = ?";
    $stmtInfoSala = mysqli_prepare($conection, $queryInfoSala);
    mysqli_stmt_bind_param($stmtInfoSala, "i", $salaId);
    mysqli_stmt_execute($stmtInfoSala);
    $resultInfoSala = mysqli_stmt_get_result($stmtInfoSala);
    $infoSala = mysqli_fetch_assoc($resultInfoSala);

    $query = "SELECT Tarea.*, Usuario.nombre AS nombre_usuario FROM Tarea INNER JOIN Usuario ON Tarea.usuario_id = Usuario.usuario_id WHERE Tarea.sala_id = ?";
    $stmt = mysqli_prepare($conection, $query);
    mysqli_stmt_bind_param($stmt, "i", $salaId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $tareas = array();
    while($fila = mysqli_fetch_assoc($result)) {
        $tareas[] = $fila;
    }
    echo json_encode(array('infoSala' => $infoSala, 'tareas' => $tareas));
} else {
    echo json_encode(array('error' => 'Acceso no autorizado'));
}
mysqli_close($conection);
?>

