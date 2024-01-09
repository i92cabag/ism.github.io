<?php

include 'conexion.php';
session_start();

if (isset($_SESSION['correo'])) {

    $correoUsuario = $_SESSION['correo'];
    $consulta = "SELECT nombre, correo, foto_perfil FROM usuario WHERE correo = '$correoUsuario'";
    $resultado = mysqli_query($conection, $consulta);

    if ($resultado) {
        if (mysqli_num_rows($resultado) == 1) {
            $fila = mysqli_fetch_assoc($resultado);
            $nombreUsuario = $fila['nombre'];
            $correoUsuario = $fila['correo'];
            $fotoPerfil = $fila['foto_perfil'];
        } else {
            // Maneja el caso en el que no se encuentren resultados
            $nombreUsuario = "Nombre no encontrado";
            $correoUsuario = "Correo no encontrado";
            $fotoPerfil = "imagenes/perfilEstandar.png";
        }
    } else {
        // Maneja el caso de error en la consulta
        echo "Error en la consulta: " . mysqli_error($conection);
        $nombreUsuario = "Nombre no disponible";
        $correoUsuario = "Correo no disponible";
        $fotoPerfil = "imagenes/perfilEstandar.png";
    }

    // Libera el resultado de la consulta
    mysqli_free_result($resultado);
} else {
    // El usuario no ha iniciado sesión, redirige a la página de inicio de sesión
    header('Location: iniciar_sesion.html');
    exit();
}

// Cierra la conexión
mysqli_close($conection);

// Redirección a tus_casas.html si se envía el formulario
if (isset($_POST['editarPerfil'])) {
    header('Location: editar_usuario.html');
    exit();
}
if (isset($_POST['volverAtras'])) {
    header('Location: tus_casas.html');
    exit();
}
if (isset($_POST['cambiarContraseña'])) {
    header('Location: cambiar_contrasena.html');
    exit();
}
if (isset($_POST['cerrarSesion'])) {
    // Destruye la sesión actual
    session_destroy();

    // Redirige a la página de inicio de sesión
    header('Location: iniciar_sesion.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <link rel="stylesheet" href="perfil.css">
    <style>
        img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <div class="form-header">
            <h2>Mi Perfil</h2>
        </div>

        <!-- Mostrar la foto de perfil -->
        <img src="<?php echo $fotoPerfil; ?>" alt="Foto de perfil">

        <p><strong>Nombre:</strong> <?php echo $nombreUsuario; ?></p>
        <p><strong>Correo:</strong> <?php echo $correoUsuario; ?></p>


        <!-- Botones -->
        <button type="submit" name="editarPerfil">Editar Perfil</button>
        <button type="submit" name="cambiarContraseña">Cambiar Contraseña</button>
        <button type="submit" name="cerrarSesion">Cerrar Sesión</button>

        <!-- Botón para volver atrás -->
        <button type="submit" name="volverAtras">Volver Atrás</button>

    </form>

    <script src="perfil.js"></script>

</body>

</html>
