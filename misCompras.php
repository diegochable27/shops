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
    <title>Mis compras</title>
</head>

<body>
    <?php
    session_start();
    include_once "./public/navbar/navbar.php";
    include("./db/conexion.php");
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM compras WHERE id_usuario = '$id'";
    $result = mysqli_query($conexion, $sql);
    $carritototal = $result->num_rows;
    //si no hay compras
    if ($carritototal == 0) {
        echo '<div class="container mt-5">
        <div class="alert alert-danger" role="alert">
            No hay compras
        </div>
    </div>';
    } else {
    ?>
        <div class="container mt-5 mb-5">
            <div class="d-flex justify-content-center row">
                <div class="col-md-10 bg-warning">
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<div class="d-flex flex-row justify-content-between align-items-center p-2 bg-white mt-4 px-3 rounded">';
                        echo '<div class="mr-1"><img class="rounded" src="' . $row['foto'] . '" width="70" alt=""></div>';
                        echo '<div class="d-flex flex-column align-items-center product-details"><span class="font-weight-bold">' . $row['nombre'] . '</span></div>';
                        echo '<div class="d-flex flex-row align-items-center qty"><h5 class="text-grey mt-1 mr-1">Cantidad: ' . $row['cantidad'] . '</h5></div>';
                        echo '<div><span class="text-grey">Precio: $' . $row['precio'] . '</span></div>';
                        echo '</div>';



                    ?>
                    <br>
                        
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php }
    include_once "./public/footer/footer.php"; ?>
</body>

</html>