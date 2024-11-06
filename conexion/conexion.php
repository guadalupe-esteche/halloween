<?php
// Función para conectar a la base de datos
function conectar()
{
    // Crear la conexión usando mysqli
    global $con;
    $con = mysqli_connect("localhost", "root", "guada12120038", "halloween");

    // Comprobar si la conexión tuvo éxito
    if (!$con) {
        // Si falla la conexión, mostrar el error
        printf("Falló la conexión: %s\n", mysqli_connect_error());
        return false;  // Retornar false en caso de error
    }

    // Establecer la codificación de caracteres UTF-8
    $con->set_charset("utf8");

    // Retornar la conexión si todo salió bien
    return $con;
}

// Función para desconectar la base de datos
function desconectar($con)
{
    // Cerrar la conexión recibida como parámetro
    mysqli_close($con);
}
?>
