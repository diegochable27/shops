<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.bundle.js.map"></script>
    <link href="./styles/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <link href="./styles/navbarestilos.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="./styles/AgregarStyles.css" />
    <link href="http://localhost/shops/public/styles/productostyles.css">
    <title>Productos</title>
</head>

<?php
session_start();
include_once "./public/navbar/navbar.php";
include("./db/conexion.php");
?>

<br>
<div class="container">
    <!-- filtro para los productos -->
    <div class="row">
        <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
            <div class="card mb-3">
                <div class="card-header bg-warning text-white">
                    <i class="fa-solid fa-filter me-2"></i>
                    Filtros
                </div>
                <div class="card-body">
                    <form action="./todoslosproductos.php" class="row" method="GET">
                        <div class="d-flex">
                            <div class="mb-3">
                                <select class="form-select" name="categoria" aria-label="Default select example" name="categoria">
                                    <option selected>Selecciona una categoria</option>
                                    <?php

                                    $sql = "SELECT * FROM categoria";
                                    $result = mysqli_query($conexion, $sql);
                                    $row = mysqli_fetch_array($result);
                                    while ($row = mysqli_fetch_array($result)) {
                                        $id = $row['id_categoria'];
                                        $nombre = $row['nombre'];
                                        echo "<option value='$id'>$nombre</option>";
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="">

                                </label>
                                <input type="submit" class="btn btn-warning" name="Buscar" value="Buscar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>



<div class="row container">

    <?php
   
    if(isset($_GET["Buscar"])){
        $categoria = $_GET["categoria"];
        $sql = "SELECT * FROM Productos WHERE id_categoria = '$categoria'";
    }else{
        $sql = "SELECT * FROM Productos";
    }
    
    $result = mysqli_query($conexion, $sql);
    if (mysqli_num_rows($result) == 0) {
        echo '<div class="alert alert-danger" role="alert">
                No hay productos disponibles
              </div>';
    }

    while ($row = mysqli_fetch_array($result)) {
        $nombre = $row['nombre'];
        $descripcion = $row['descripcion'];
        $idproducto = $row['id_producto'];
        if (strlen($descripcion) > 80) {
            $descripcion = substr($descripcion, 0, 80) . "...";
        }

        $sqlfotos = "SELECT * FROM imagenes WHERE propietario = '$row[nombre]'";
        $resultfotos = mysqli_query($conexion, $sqlfotos);
        //solo guardar el primer resultado
        $rowfotos = mysqli_fetch_array($resultfotos);
        $foto = $rowfotos['ruta_imagen'];
        $precio = $row['precio'];
        if ($row["cantidad"] >= 0) {



    ?>

            <div class="col-lg-4 col-md-6 col-sm-12" style="width: 400px;">
                <?php
                echo '<a href="./vistadeproducto.php?id=' . $idproducto . '" class="text-decoration-none">';
                ?>
                <div class="card mb-3">
                    <div class="position-relative">
                        <?php echo '<img class="card-img-top img-fluid" style="height: 200px; object-fit: cover;" src="' . $foto . '" alt="Nombre del Producto">' ?>
                        <div class="position-absolute top-0 end-0 m-2">
                            <form action="./todoslosproductos.php">
                                <button type="button" class="btn btn-outline-secondary" name=<?php echo "favorito" . $idproducto ?>><i class="far fa-heart"></i></button>
                                <button type="submit" class="btn btn-outline-secondary ms-2" name=<?php echo "carrito" . $idproducto ?>><i class="fas fa-shopping-cart"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-decoration-none text-warning"><?php echo $nombre ?></h5>
                        <p class="card-text text-decoration-none text-dark"><?php echo $descripcion ?></p>
                        <h5 class="card-text text-decoration-none text-primary">$<?php echo $precio ?></h5>
                    </div>
                </div>
                </a>
            </div>

    <?php
            if (isset($_GET["carrito" . $idproducto])) {
                //si el carrito ya tiene el producto, solo aumentar la cantidad
                $sql2 = "SELECT * FROM carrito WHERE id_product = '$idproducto' AND id_usuario = '$_SESSION[id]'";
                $result2 = mysqli_query($conexion, $sql2);
                $row2 = mysqli_fetch_array($result2);
                //si es diferente a null el resultado se haha

                if ($row2['id_product'] == $idproducto) {
                    $cantidad2 = $row2['cantidad'];
                    $cantidad2 = $cantidad2 + 1;
                    $sql3 = "UPDATE carrito SET cantidad = '$cantidad2' WHERE id_product = '$idproducto' AND id_usuario = '$_SESSION[id]'";
                    $result3 = mysqli_query($conexion, $sql3);
                    if ($result3) {
                        echo '<script>alert("Producto agregado al carrito")</script>';
                    }
                } else {


                    $sqlcarrito = "INSERT INTO carrito (id_product, id_usuario, precio, cantidad) VALUES ('$idproducto', '$_SESSION[id]', '$precio', 1)";
                    $resultcarrito = mysqli_query($conexion, $sqlcarrito);
                    if ($resultcarrito) {
                        echo '<script>alert("Producto agregado al carrito")</script>';
                    }
                }
            }

            if (isset($_GET["favorito" . $idproducto])) {
                $sqlfavorito = "INSERT INTO favoritos (id_product, id_usuario) VALUES ('$idproducto', '$_SESSION[id]')";
                $resultfavorito = mysqli_query($conexion, $sqlfavorito);

                if ($resultfavorito) {
                    echo '<script>alert("Producto agregado a favoritos")</script>';
                } else {
                    echo '<script>alert("Error al agregar el producto a favoritos")</script>';
                }
            }
        }
    }
    ?>

</div>
</div>
<br>
<?php include_once "./public/footer/footer.php"; ?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>