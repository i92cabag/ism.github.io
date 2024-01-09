<?php
include 'conexion.php';
session_start();

// Recibir datos
$datos = json_decode(file_get_contents('php://input'), true);
$casaId = $datos['casaId'];

//Eliminar tareas asociadas a la casa
$queryEliminarTareas = "DELETE FROM Tarea WHERE casa_id = ?";
$stmtEliminarTareas = mysqli_prepare($conection, $queryEliminarTareas);
mysqli_stmt_bind_param($stmtEliminarTareas, "i", $casaId);
mysqli_stmt_execute($stmtEliminarTareas);

//Eliminar zonas asociadas a la casa
$queryEliminarSalas = "DELETE FROM Sala WHERE casa_id = ?";
$stmtEliminarSalas = mysqli_prepare($conection, $queryEliminarSalas);
mysqli_stmt_bind_param($stmtEliminarSalas, "i", $casaId);
mysqli_stmt_execute($stmtEliminarSalas);


// Eliminar entradas relacionadas en UsuarioCasa
$queryUsuarioCasa = "DELETE FROM UsuarioCasa WHERE casa_id = ?";
$stmtUsuarioCasa = mysqli_prepare($conection, $queryUsuarioCasa);
mysqli_stmt_bind_param($stmtUsuarioCasa, "i", $casaId);
mysqli_stmt_execute($stmtUsuarioCasa);

// Eliminar la casa
$queryCasa = "DELETE FROM Casa WHERE casa_id = ?";
$stmtCasa = mysqli_prepare($conection, $queryCasa);
mysqli_stmt_bind_param($stmtCasa, "i", $casaId);
mysqli_stmt_execute($stmtCasa);

echo json_encode(["mensaje" => "Casa eliminada correctamente"]);
mysqli_close($conection);
?>
