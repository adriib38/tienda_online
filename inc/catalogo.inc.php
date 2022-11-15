<h2>Productos</h2>
    <?php
        include('inc/Conexion.inc.php');
        
        //Consulta SELECT de los productos
        $resultado = $conexion->query('SELECT * FROM `productos`;');
        unset($conexion);
        //Imprime los productos, resultados obtenidos de la consulta
        echo '<div class="productos">';
        while ($registro = $resultado->fetch()) {
            ?>    
            <div>
                <h3><?=$registro['nombre']??'' ?></h3>
                <p><?=$registro['categoria']??'' ?></p>
                <p><?=$registro['precio']??'' ?>€</p>
                <img width="250px" src="<?=$registro['imagen']??'' ?>">
                <p>Stock <?=$registro['stock']??'' ?></p>
                <div class="product-buttons">
                    <a href="index.php?action=sumar&product=<?=$registro['codigo']??'' ?>">
                        <i class="fa-solid fa-circle-plus"></i>
                    </a>
                    <a href="index.php?action=restar&product=<?=$registro['codigo']??'' ?>">
                        <i class="fa-solid fa-circle-minus"></i>
                    </a>
                    <a href="index.php?action=eliminar&product=<?=$registro['codigo']??'' ?>">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>

                </div>
            </div>
        <?php
        }
        echo '</div>';
    ?>
    </div>