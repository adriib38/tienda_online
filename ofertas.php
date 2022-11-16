<?php
    session_start();
    include('inc/User.inc.php');


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofertas</title>

    <link rel="stylesheet" href="styles/style.css">
    <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>
</head>
</head>
<body>  
    <?php
        if(isset($_SESSION['usuario'])){
            if($_SESSION['usuario']->rol == 'cliente'){
                include('inc/cabecera_cliente.inc.php');
            }else{
                include('inc/cabecera_admin.inc.php');
            }
        }else{
            include('inc/cabecera.inc.php');
        }

    ?>
    <h2>Ofertas</h2>
    <h3>No hay ofertas de momento</h3>

</body>
</html>