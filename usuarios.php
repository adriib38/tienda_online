<?php
    include('inc/User.inc.php');

    session_start();
    //Si la sesión de usuario está iniciada redirige a index.
    if($_SESSION['usuario']->rol != 'admin'){
        print_r($_SESSION['usuario']->rol);
       //header('Location: index.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>

    <link rel="stylesheet" href="styles/style.css">
    <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        include('inc/Conexion.inc.php');
        
        //Consulta SELECT de los productos
        $resultado = $conexion->query('SELECT * FROM `usuarios`;');
        unset($conexion);
        //Imprime los productos, resultados obtenidos de la consulta
        echo '<table class="usuarios">';
        while ($registro = $resultado->fetch()) {
            echo '<tr>';
            echo '<td>';
            echo ''.$registro["usuario"].'';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
    ?>
</body>
</html>