<?php

    include 'conexion.php';
    session_start();

    $usuarioId = $_SESSION['usuario_id'];

    // Obtener casas creadas por el usuario
    $query = "SELECT * FROM Casa WHERE usuario_id = ?";
    $stmt = mysqli_prepare($conection, $query);
    mysqli_stmt_bind_param($stmt, "i", $usuarioId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $casas = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Obtener casas asociadas al usuario
    $queryUsuarioCasa = "SELECT Casa.* FROM Casa INNER JOIN UsuarioCasa ON Casa.casa_id = UsuarioCasa.casa_id WHERE UsuarioCasa.usuario_id = ?";
    $stmtUsuarioCasa = mysqli_prepare($conection, $queryUsuarioCasa);
    mysqli_stmt_bind_param($stmtUsuarioCasa, "i", $usuarioId);
    mysqli_stmt_execute($stmtUsuarioCasa);
    $resultUsuarioCasa = mysqli_stmt_get_result($stmtUsuarioCasa);
    while($fila = mysqli_fetch_assoc($resultUsuarioCasa)) {
        $casas[] = $fila;
    }

    echo json_encode($casas);

    mysqli_close($conection);
?> 
