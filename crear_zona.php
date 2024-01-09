<?php
include 'conexion.php';
session_start();

if (isset($_SESSION['usuario_id'])) {
    $nombreSala = $_POST['nombre_sala'];
    $casaId = $_POST['casa_id'];
    $tipoZona = $_POST['tipoZona'];


    $consultaExistencia = "SELECT * FROM Sala WHERE nombre_sala = ? AND casa_id = ?";
    $stmtExistencia = mysqli_prepare($conection, $consultaExistencia);
    mysqli_stmt_bind_param($stmtExistencia, "si", $nombreSala, $casaId);
    mysqli_stmt_execute($stmtExistencia);
    mysqli_stmt_store_result($stmtExistencia);

    if (mysqli_stmt_num_rows($stmtExistencia) > 0) {
        echo "Ya tienes una zona con ese nombre";
    } else {
        $query = "INSERT INTO Sala (nombre_sala, casa_id, tipoZona) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conection, $query);
        mysqli_stmt_bind_param($stmt, "sis", $nombreSala, $casaId, $tipoZona);
        $success = mysqli_stmt_execute($stmt);

        if ($success) {
            echo "Zona creada con éxito";
        } else {
            echo "Error al crear la zona";
        }

        mysqli_stmt_close($stmtExistencia);
        mysqli_stmt_close($stmt);
    }
} else {
    echo "Usuario no logueado";
}

mysqli_close($conection);
?>
