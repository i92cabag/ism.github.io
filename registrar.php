<?php
include 'conexion.php';

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contrasena = $_POST['contraseña'];

// Validar longitud de la contraseña
if (strlen($contrasena) < 6) {
    echo "La contraseña debe tener al menos 6 caracteres.";
    exit();
}

// Verificar si el correo ya existe en la base de datos
$consulta = "SELECT * FROM usuario WHERE correo = '$correo'";
$resultado = mysqli_query($conection, $consulta);

if (mysqli_num_rows($resultado) > 0) {
    // El correo ya existe, muestra una alerta
    echo "<script>
    alert('El correo electrónico ya está registrado. Por favor, elige otro.');
    window.location.href = 'registrarse.html';
    </script>";
    exit();
} else {
    // El correo no existe, procede con la inserción en la base de datos
    $ruta_foto = '';

    if (!empty($_FILES['fotoPerfil']['name'])) {
        $nombre_foto = $_FILES['fotoPerfil']['name'];
        $ruta_foto = "imagenes/$nombre_foto";
        move_uploaded_file($_FILES['fotoPerfil']['tmp_name'], $ruta_foto);
    } else {
        $ruta_foto = "imagenes/perfilEstandar.png";
    }

    $registrar = "INSERT INTO usuario (nombre, correo, contraseña, foto_perfil) VALUES ('$nombre', '$correo', '$contrasena', '$ruta_foto')";
    $ejecutar = mysqli_query($conection, $registrar);

    if ($ejecutar) {
        // Redirige a la página "iniciar_sesion.html" después del registro exitoso
        header('Location: iniciar_sesion.html');
        exit();
    } else {
        echo "Error al registrar el usuario: " . mysqli_error($conection);
    }
}

// Cierra la conexión
mysqli_close($conection);
?>
