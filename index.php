<?php
include_once("conexion/conexion.php");

conectar();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Concurso de disfraces de Halloween</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="index.php">Ver Disfraces</a></li>
            <li><a href="index.php?modulo=procesar_registro">Registro</a></li>
            <li><a href="index.php?modulo=procesar_login">Iniciar Sesión</a></li>
            <li><a href="index.php?modulo=procesar_disfraz">Panel de Administración</a></li>
        </ul>
    </nav>
    <header>
        <h1>Concurso de disfraces de Halloween</h1>
        
        <?php
        if(!empty($_SESSION['nombre_usuario']))
        {
            ?>
            <p>Hola <?php echo $_SESSION['nombre_usuario'];?>. usted tiene el ID: <?php echo $_SESSION['id'];?></p>
            <a href="index.php?modulo=procesar_login&salir=ok">SALIR</a>
            <?php
        }
        ?>
    </header>
    <main>
       
    <?php
        if (!empty($_GET['modulo']))
        {
            include('modulos/'.$_GET['modulo'].'.php');
        }
        else 
        {
            // Obtén los disfraces de la base de datos
            $sql = mysqli_query($con, "SELECT id, nombre FROM disfraces");

            // Muestra cada disfraz
            while ($disfraz = mysqli_fetch_array($sql)) {
                echo "<section id='disfraces-list' class='section'>";
                echo "<div class='disfraz'>";
                echo "<h2>" . htmlspecialchars($disfraz['nombre']) . "</h2>";
                
                // Muestra la foto usando mostrar_foto.php
                echo "<img src='mostrar_foto.php?id=" . urlencode($disfraz['id']) . "' alt='Foto del disfraz'>";
                
                // Formulario para votar por el disfraz
                echo "<form action='modulos/guardar_voto.php' method='POST'>";
                echo "<input type='hidden' name='id' value='" . htmlspecialchars($disfraz['id']) . "'>";
                // Verifica si el usuario ya votó por este disfraz
                $sql_check = mysqli_query($con, "SELECT * FROM votos WHERE id_disfraz = " . intval($disfraz['id']) . " AND id_usuario = " . intval($_SESSION['id']));
                if (mysqli_num_rows($sql_check) == 0) {
                    // Si no ha votado, muestra el botón de votar
                    echo "<form action='modulos/guardar_voto.php' method='POST'>";
                    echo "<input type='hidden' name='id' value='" . htmlspecialchars($disfraz['id']) . "'>";
                    echo "<button type='submit'>Votar</button>";
                    echo "</form>";
                } else {
                    // Si ya ha votado, muestra un mensaje
                    echo "<p>Ya has votado por este disfraz.</p>";
                }
                echo "</form>";
                echo "</div>";
                echo "</section>";
            }
        }
        ?>
    </main>
    <script src="js/script.js"></script>
</body>
</html>
