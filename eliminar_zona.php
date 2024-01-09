<?php
include 'conexion.php';
session_start();

// Recibir datos
$datos = json_decode(file_get_contents('php://input'), true);
$salaId = $datos['salaId'];

//Eliminar tareas asociadas a la sala
$queryEliminarTareas = "DELETE FROM Tarea WHERE sala_id = ?";
$stmtEliminarTareas = mysqli_prepare($conection, $queryEliminarTareas);
mysqli_stmt_bind_param($stmtEliminarTareas, "i", $salaId);
mysqli_stmt_execute($stmtEliminarTareas);

// Eliminar la zona
$queryZona = "DELETE FROM Sala WHERE sala_id = ?";
$stmtZona = mysqli_prepare($conection, $queryZona);
mysqli_stmt_bind_param($stmtZona, "i", $salaId);
mysqli_stmt_execute($stmtZona);

echo json_encode(["mensaje" => "Zona eliminada correctamente"]);
mysqli_close($conection);
?>