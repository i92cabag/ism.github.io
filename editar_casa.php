<?php
include 'conexion.php';
session_start();

// Recibir datos
$datos = json_decode(file_get_contents('php://input'), true);
$casaId = $datos['casaId'];
$nuevoNombreCasa = $datos['nuevoNombreCasa'] ?? null;
$correoUsuario = $datos['correoUsuario'] ?? null;

// Actualizar nombre de la casa
if ($nuevoNombreCasa) {
    $query = "UPDATE Casa SET nombre_casa = ? WHERE casa_id = ?";
    $stmt = mysqli_prepare($conection, $query);
    mysqli_stmt_bind_param($stmt, "si", $nuevoNombreCasa, $casaId);
    mysqli_stmt_execute($stmt);
}

// Añadir nuevo usuario
if ($correoUsuario) {
    // Verificar existencia del usuario
    $queryUsuario = "SELECT usuario_id FROM Usuario WHERE correo = ?";
    $stmtUsuario = mysqli_prepare($conection, $queryUsuario);
    mysqli_stmt_bind_param($stmtUsuario, "s", $correoUsuario);
    mysqli_stmt_execute($stmtUsuario);
    $resultUsuario = mysqli_stmt_get_result($stmtUsuario);

    if ($row = mysqli_fetch_assoc($resultUsuario)) {
        $usuarioId = $row['usuario_id'];

        // Insertar en UsuarioCasa
        $queryUsuarioCasa = "INSERT INTO UsuarioCasa (usuario_id, casa_id) VALUES (?, ?)";
        $stmtUsuarioCasa = mysqli_prepare($conection, $queryUsuarioCasa);
        mysqli_stmt_bind_param($stmtUsuarioCasa, "ii", $usuarioId, $casaId);
        mysqli_stmt_execute($stmtUsuarioCasa);
    } else {
        echo json_encode(["mensaje" => "Correo no registrado"]);
        exit;
    }
}

echo json_encode(["mensaje" => "Casa actualizada correctamente"]);
mysqli_close($conection);
?>
