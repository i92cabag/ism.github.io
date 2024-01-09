<?php

include 'conexion.php';
session_start();

// Recibir los datos en formato JSON
$datosJson = file_get_contents('php://input');
$datos = json_decode($datosJson, true);

// Verificar si el usuario está logueado
if(isset($_SESSION['usuario_id'])) {
    $nombre_tarea = $datos['nombre_tarea'];
    $usuario_id = $datos['usuario_id'];
    $casa_id = $datos['casa_id'];
    $sala_id = $datos['sala_id'];


    $consultaExistencia = "SELECT * FROM Tarea WHERE nombre_tarea = ? AND sala_id = ? AND casa_id = ?";
    $stmtExistencia = mysqli_prepare($conection, $consultaExistencia);
    mysqli_stmt_bind_param($stmtExistencia, "sii", $nombre_tarea, $sala_id, $casa_id);
    mysqli_stmt_execute($stmtExistencia);
    mysqli_stmt_store_result($stmtExistencia);

    if (mysqli_stmt_num_rows($stmtExistencia) > 0) {
        echo "Ya tienes una tarea con ese nombre en esta sala";
    } else {
        $query = "INSERT INTO Tarea (nombre_tarea, casa_id, sala_id, usuario_id, realizada) VALUES (?, ?, ?, ?, false)";
        $stmt = mysqli_prepare($conection, $query);
        mysqli_stmt_bind_param($stmt, "siii", $nombre_tarea, $casa_id, $sala_id, $usuario_id);
        $success = mysqli_stmt_execute($stmt);

        if ($success) {
            echo "Tarea creada con éxito";
        } else {
            echo "Error al crear la tarea: " . mysqli_error($conection);
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_stmt_close($stmtExistencia);
} else {
    echo "Usuario no logueado";
}

mysqli_close($conection);
?>
