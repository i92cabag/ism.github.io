<?php

include 'conexion.php';
session_start();

if(isset($_POST['tarea_id'])) {
    $tareaId = $_POST['tarea_id'];
    $usuarioIdActual = $_SESSION['usuario_id'];

    // Verifica si el usuario actual está asignado a la tarea
    $query = "SELECT * FROM Tarea WHERE tarea_id = ? AND usuario_id = ?";
    $stmt = mysqli_prepare($conection, $query);
    mysqli_stmt_bind_param($stmt, "ii", $tareaId, $usuarioIdActual);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0) {
        // Actualiza el estado de la tarea a completado
        $updateQuery = "UPDATE Tarea SET realizada = 1 WHERE tarea_id = ?";
        $updateStmt = mysqli_prepare($conection, $updateQuery);
        mysqli_stmt_bind_param($updateStmt, "i", $tareaId);
        mysqli_stmt_execute($updateStmt);
        echo "Tarea completada con éxito";
    } else {
        echo "No tienes permiso para completar esta tarea";
    }
} else {
    echo "Datos de tarea no proporcionados";
}

mysqli_close($conection);
?>

