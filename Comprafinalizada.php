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
    <title>Felizadades</title>
</head>

<body>
    <?php
    session_start();
    include_once "./public/navbar/navbar.php";
    ?>

    <div class="container mt-5">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">¡Felicidades!</h4>
            <p>Tu compra ha sido realizada con éxito. Agradecemos tu preferencia.</p>
            <hr>
            <p class="mb-0">Te enviaremos un correo electrónico con los detalles de tu pedido.</p>
        </div>
    </div>

    <?php include_once "./public/footer/footer.php"; ?>

</body>

</html>