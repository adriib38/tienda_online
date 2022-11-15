<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="styles/style.css">
    <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php 
        include('inc/cabecera.inc.php');
    ?>
    <form action="#" method="post">
        Usuario o email: <input type="text" name="usuario" id="">
        Password: <input type="password" name="pass" id="">
        <input type="submit" value="Login">
    </form>
</body>
</html>