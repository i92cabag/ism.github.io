<?php
include 'conexion.php';

session_start();

if (isset($_SESSION['usuario_id'])) {

    $usuarioId = $_SESSION['usuario_id'];
    $nombreCasa = $_POST['nombreCasa'];

    // Validar si ya existe una casa con el mismo nombre para el usuario actual
    $consultaExistencia = "SELECT * FROM casa WHERE nombre_casa = '$nombreCasa' AND usuario_id = '$usuarioId'";
    $resultadoExistencia = mysqli_query($conection, $consultaExistencia);

    if ($resultadoExistencia && mysqli_num_rows($resultadoExistencia) > 0) {
        // Ya existe una casa con ese nombre para el usuario actual
        echo "<script>alert('Ya tienes una casa con ese nombre');</script>";
        echo "<script>window.location.href = 'crear_casa.html';</script>";
    } else {
        // No existe una casa con ese nombre, se puede agregar
        $nuevaCasa = "INSERT INTO casa (nombre_casa, usuario_id) VALUES ('$nombreCasa', '$usuarioId')";
        $ejecutar = mysqli_query($conection, $nuevaCasa);

        if ($ejecutar) {
            echo "<script>alert('Casa añadida con éxito');
            window.location.href = 'tus_casas.html';
            </script>";
        } else {
            echo "<script>alert('Error al añadir la casa');</script>";
        }
    }

    mysqli_free_result($resultadoExistencia);

}

mysqli_close($conection);
?>
