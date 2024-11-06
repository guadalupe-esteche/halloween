<?php
session_start();
include_once("../conexion/conexion.php");
conectar();

if (isset($_POST['id']) && isset($_SESSION['id'])) {
    $disfraz_id = intval($_POST['id']);
    $usuario_id = intval($_SESSION['id']);
    
    $sql = mysqli_query($con, "INSERT INTO votos (id_disfraz, id_usuario) VALUES ($disfraz_id, $usuario_id)");
    
    if ($sql) {
        echo "<scrip> Voto emitido correctamente </scrip>";
        header("Location: ../index.php"); // Redirige a la página principal 
        exit();
    } else {
        echo "Error: no se pudo emitir el voto";
    }
} else {
    echo "Error: No se recibió un ID de disfraz o ID de usuario válido.";
}
?>
