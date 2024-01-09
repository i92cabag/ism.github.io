<?php
    include 'conexion.php';

    // Verifica si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera los valores del formulario
        $correo = mysqli_real_escape_string($conection, $_POST['correo']);
        $contraseña = mysqli_real_escape_string($conection, $_POST['contraseña']);

        // Consulta SQL para buscar el usuario en la base de datos
        $consulta = "SELECT * FROM Usuario WHERE correo = '$correo' AND contraseña = '$contraseña'";
        $resultado = mysqli_query($conection, $consulta);

        // Verifica si se encontró el usuario
        if ($resultado && mysqli_num_rows($resultado) == 1) {
            $fila = mysqli_fetch_assoc($resultado);
            // Inicio de sesión exitoso
            session_start();
            $_SESSION['correo'] = $correo;
            $_SESSION['usuario_id'] = $fila['usuario_id'];

            // Redirecciona a la página tuscasas.html
            header('Location: tus_casas.html');
            exit();
        } else {
            // Usuario no encontrado o contraseña incorrecta
            echo "<script>alert('Correo o contraseña incorrectos');
            window.location.href = 'iniciar_sesion.html';
            </script>";
    
        }

        // Libera el resultado de la consulta
        mysqli_free_result($resultado);
    }

    // Cierra la conexión
    mysqli_close($conection);
?>