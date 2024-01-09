<?php
include 'conexion.php';

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conection, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conection, $_POST['correo']);
    $nuevaContraseña = mysqli_real_escape_string($conection, $_POST['nuevaContraseña']);

    // Verifica si el nombre y el correo coinciden en la base de datos
    $consulta = "SELECT * FROM Usuario WHERE nombre = '$nombre' AND correo = '$correo'";
    $resultadoConsulta = mysqli_query($conection, $consulta);

    if ($resultadoConsulta && mysqli_num_rows($resultadoConsulta) == 1) {
        // El nombre y el correo coinciden, actualiza la contraseña
        $actualizarContraseña = "UPDATE Usuario SET contraseña = '$nuevaContraseña' WHERE nombre = '$nombre' AND correo = '$correo'";
        $resultadoActualizar = mysqli_query($conection, $actualizarContraseña);

        if ($resultadoActualizar) {
            // Contraseña actualizada con éxito
            echo "<script>alert('Contraseña actualizada con éxito. Puedes iniciar sesión con tu nueva contraseña.');</script>";
            header('Location: iniciar_sesion.html');
            exit();
        } else {
            // Error al actualizar la contraseña
            echo "<script>alert('Error al actualizar la contraseña: " . mysqli_error($conection) . "');</script>";
        }
    } else {
        // El nombre o el correo no son correctos
        echo "<script>
        if (confirm('El correo o el nombre no existe. ¿Desea volver a la página de inicio?')) {
            window.location.href = 'iniciar_sesion.html';
        } else {
            window.location.href = 'cambiar_contrasena.html'; 
        }
      </script>";
    }

    // Libera el resultado de la consulta
    mysqli_free_result($resultadoConsulta);
}

// Cierra la conexión
mysqli_close($conection);
?>
