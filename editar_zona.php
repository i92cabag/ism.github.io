<?php
include 'conexion.php';
session_start();

// Recibir datos
$datos = json_decode(file_get_contents('php://input'), true);
$salaId = $datos['salaId'];
$nuevoNombreSala = $datos['nuevoNombreSala'] ?? null;

// Actualizar nombre de la sala
if ($nuevoNombreSala) {
    $query = "UPDATE Sala SET nombre_sala = ? WHERE sala_id = ?";
    $stmt = mysqli_prepare($conection, $query);
    mysqli_stmt_bind_param($stmt, "si", $nuevoNombreSala, $salaId);
    mysqli_stmt_execute($stmt);
}

echo json_encode(["mensaje" => "Sala actualizada correctamente"]);
mysqli_close($conection);
?>