<div id="cabecera">  
    <img src="img/banner-img.png" width="220px">
    <h1 class="logo">MerchaShop AdriánBenítez</h2>
</div>
    <ul class="navbar">
    <li><a href="index.php">Principal</a></li>
    <li><a href="ofertas.php">Ofertas</a></li>
    <?php
    if(isset($_SESSION['carrito'])){
        $prods = count($_SESSION['carrito']);
    }
    ?>
    <li><a href="carrito.php"><i class="fa-solid fa-cart-shopping"><?=$prods?? '0'?></i></a><li>
</ul>

