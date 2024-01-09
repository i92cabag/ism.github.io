<?php
// Datos del usuario para la inserción
$nombre = "nombre";
$correo = "correo";
$contrasena = "contraseña";

// Consulta de inserción con parámetros
$sql = "INSERT INTO usuarios (nombre, correo, contraseña) VALUES (?, ?, ?)";

// Preparar y ejecutar la consulta
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nombre, $correo, $contrasena);

if ($stmt->execute()) {
    echo "Registro exitoso";
} else {
    echo "No se pudo realizar el registro: " . $conn->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>