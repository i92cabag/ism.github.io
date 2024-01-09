<?php
// Inicia la sesión para acceder a la información del usuario
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['correo'])) {
    // Si no ha iniciado sesión, redirige al formulario de inicio de sesión
    header('Location: formulario_inicio_sesion.php');
    exit();
}

// Recupera la información del usuario desde la sesión o la base de datos
$correo = $_SESSION['correo'];

// Incluye el archivo de conexión
include 'conexion.php';

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los valores del formulario
    $nuevoNombre = $_POST['nombre'];
    $nuevoCorreo = $_POST['correo'];

    // Procesa el cambio de nombre y correo en la base de datos
    actualizarInformacionUsuarioEnBD($conection, $correo, $nuevoNombre, $nuevoCorreo);

    // Procesa el cambio de foto de perfil si se proporciona una nueva foto
    if ($_FILES['foto']['name'] !== "") {
        $rutaDestino = "imagenes/" . $correo . "_perfil.jpg";
        move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino);
        actualizarRutaFotoEnBD($conection, $correo, $rutaDestino);
    }
    
    header('Location: perfil.php');
    exit();
}

function actualizarInformacionUsuarioEnBD($conection, $correo, $nuevoNombre, $nuevoCorreo) {
    $consulta = "UPDATE usuario SET nombre=?, correo=? WHERE correo=?";
    $stmt = mysqli_prepare($conection, $consulta);
    mysqli_stmt_bind_param($stmt, "sss", $nuevoNombre, $nuevoCorreo, $correo);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function actualizarRutaFotoEnBD($conection, $correo, $rutaFoto) {
    $consulta = "UPDATE usuario SET foto_perfil=? WHERE correo=?";
    $stmt = mysqli_prepare($conection, $consulta);
    mysqli_stmt_bind_param($stmt, "ss", $rutaFoto, $correo);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
?>
