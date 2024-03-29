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
    <link href="http://localhost/shops/styles/vistadeproducto.css">
    <title></title>
</head>

<body>
    <?php
    session_start();
    include_once "./public/navbar/navbar.php";
    $id = $_GET['id'];
    if(isset($_SESSION["id"])){
        $iduser = $_SESSION["id"];
    }else{
        $iduser = "0";
    }
   
    include("./db/Conexion.php");

    $sql = "SELECT * FROM productos WHERE id_producto  = $id";
    $result = mysqli_query($conexion, $sql);

    $row = mysqli_fetch_array($result);
    $nombre = $row['nombre'];
    $precio = $row['precio'];
    $cantidad = $row['cantidad'];
    $descripcion = $row['descripcion'];
    $sqlimage = "SELECT * FROM imagenes WHERE propietario = '$nombre'";
    $resultimg = mysqli_query($conexion, $sqlimage);
    $rowimge = mysqli_fetch_array($resultimg);
    $imgen1 = $rowimge["ruta_imagen"];






    ?>
    </br>
    <div class="products">
        <div class="container card">
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div>
                        <?php
                        echo '<img src="' . $imgen1 . '" alt="" class="img-fluid wc-image" width="100%">';
                        ?>
                    </div>
                    <br>
                </div>

                <div class="col-md-8 col-xs-12">
                    <div> <!-- Agregamos una clase 'card' para crear un cuadro -->
                        <div class="card-body"> <!-- Contenido del cuadro -->

                            <h2>
                                <?php echo $nombre ?>
                            </h2>
                            <br>
                            <p class="lead">
                                <strong class="text-primary">$
                                    <?php echo $precio ?>
                                </strong>
                            </p>
                            <br>
                            <p class="lead">
                                <?php echo $descripcion ?>
                            </p>
                            <br>
                            <div class="row">
                                <div class="col-sm-8">
                                    <form action="./db/guardarcarrito.php" method="post">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" class="d-none" name="id" id="id" value=<?php echo $id ?>>
                                                    <select name="cantidad" class="form-select" id="cantidad">
                                                        <?php
                                                        for ($i = 1; $i <= $cantidad; $i++) {
                                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-primary btn-block" value="Agregar al Carrito" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </br>
    <?php include_once "./public/footer/footer.php"; ?>
</body>

</html>