<?php
include 'conexion.php';
session_start();

if(isset($_SESSION['usuario_id'])) {
    // Obtén el ID de la tarea a eliminar desde la solicitud POST o GET
    $tareaId = $_POST['tarea_id']; // Puedes cambiar esto según cómo estés enviando el ID
    
    // Preparar y ejecutar la consulta para eliminar la tarea
    $query = "DELETE FROM Tarea WHERE tarea_id = ?";
    $stmt = mysqli_prepare($conection, $query);
    mysqli_stmt_bind_param($stmt, "i", $tareaId);
    $success = mysqli_stmt_execute($stmt);

    if ($success) {
        echo "Tarea eliminada con éxito";
    } else {
        echo "Error al eliminar la tarea: " . mysqli_error($conection);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Usuario no logueado";
}

mysqli_close($conection);
?>
