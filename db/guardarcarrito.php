<?php
$idproducto = $_POST["id"];
$Cantidad = $_POST["cantidad"];
session_start();
include("./conexion.php");
$iduser = $_SESSION["id"];
$sql = "SELECT * FROM productos WHERE id_producto  = $idproducto";
$result = mysqli_query($conexion, $sql);
$sql2 = "SELECT * FROM carrito WHERE id_product = '$idproducto' AND id_usuario = '$iduser'";
$result2 = mysqli_query($conexion, $sql2);
$row2 = mysqli_fetch_array($result2);
if ($row2['id_product'] == $idproducto) {
    $cantidad2 = $row2['cantidad'];
    $cantidad2 = $cantidad2 + $Cantidad;
    $sql3 = "UPDATE carrito SET cantidad = '$cantidad2' WHERE id_product = '$idproducto' AND id_usuario = '$iduser'";
    $result3 = mysqli_query($conexion, $sql3);
    if ($result3) {
        echo '<script>alert("Producto agregado al carrito")
            window.location= "../vistadeproducto.php?id=' . $idproducto . '"
            </script>';
    }
}else{


    $row = mysqli_fetch_array($result);
    $precio = $row['precio'];
    $precio = $precio * $Cantidad;
    $sqlcarrito = "INSERT INTO carrito (id_product, id_usuario, precio, cantidad) VALUES ('$idproducto', '$iduser', '$precio', '$Cantidad')";
    $resultcarrito = mysqli_query($conexion, $sqlcarrito);
    if ($resultcarrito) {
        echo '<script>alert("Producto agregado al carrito")
            window.location= "../vistadeproducto.php?id=' . $idproducto . '"
            </script>';
    }
}

?>
