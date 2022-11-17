<?php

    include('inc/User.inc.php');

    //Si la sesión de usuario está iniciada redirige a index.
    if($_SESSION['usuario']->rol != 'admin'){
        header('Location: index.php');
    }

    session_start();
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios - MerchaShop</title>

    <link rel="stylesheet" href="styles/style.css">
    <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        include('inc/Conexion.inc.php');
        include('inc/cabecera_admin.inc.php');

        echo '<h2>Usuarios</h2>';
        //Consulta SELECT de los usurio
        $resultado = $conexion->query('SELECT * FROM `usuarios`;');
        unset($conexion);
        //Imprime los usuarios, resultados obtenidos de la consulta
        echo '<table class="usuarios">';
        echo '<tr>';
        echo '<td>Usuario</td>';
        echo '<td>Email</td>';
        echo '<td>Rol</td>';
        echo '<tr>';
        while ($registro = $resultado->fetch()) {
            echo '<tr>';
                echo '<td>';
                echo ''.$registro["usuario"].'';
                echo '</td>';
                echo '<td>';
                echo ''.$registro["email"].'';
                echo '</td>';
                echo '<td>';
                echo ''.$registro["rol"].'';
                echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
    ?>
</body>
</html>