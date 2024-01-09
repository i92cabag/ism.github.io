<?php
include 'conexion.php';
session_start();

$casaId = isset($_GET['casaId']) ? $_GET['casaId'] : null;

$query = "SELECT DISTINCT u.nombre, u.usuario_id
    FROM Usuario u
    WHERE u.usuario_id IN (
    SELECT uc.usuario_id FROM UsuarioCasa uc WHERE uc.casa_id = ?
    UNION
    SELECT c.usuario_id FROM Casa c WHERE c.casa_id = ?)";

$stmt = mysqli_prepare($conection, $query);
mysqli_stmt_bind_param($stmt, "ii", $casaId, $casaId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$usuarios = [];
while ($fila = mysqli_fetch_assoc($result)) {
    $usuarios[] = [
        'id' => $fila['usuario_id'],
        'nombre' => $fila['nombre']
    ];
}

echo json_encode($usuarios);
mysqli_close($conection);
?>
