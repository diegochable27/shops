<?php
require("conexion.php");
session_start();
$id = $_SESSION['id'];
$sql = "SELECT * FROM carrito WHERE id_usuario = '$id'";
$result = mysqli_query($conexion, $sql);
$carritototal = $result->num_rows;
$_SESSION["Carritototal"] = $carritototal;
//eliminar todos carritos de usuaario
$sql2 = "DELETE FROM carrito WHERE id_usuario = '$id'";
$result2 = mysqli_query($conexion, $sql2);
//insertar en compras
while ($row = mysqli_fetch_array($result)) {
    $idtodo = $row['id'];
    $idproducto = $row['id_product'];
    $sql3 = "SELECT * FROM Productos WHERE id_producto = '$idproducto'";
    $result3 = mysqli_query($conexion, $sql3);
    $row3 = mysqli_fetch_array($result3);
    $nombre = $row3['nombre'];
    $descripcion = $row3['descripcion'];
    $precio = $row3['precio'];
    $sqlfotos = "SELECT * FROM imagenes WHERE propietario = '$row3[nombre]'";
    $resultfotos = mysqli_query($conexion, $sqlfotos);
    $rowfotos = mysqli_fetch_array($resultfotos);
    $foto = $rowfotos['ruta_imagen'];
    $preciototal = $_SESSION["total"] + $precio;
    $_SESSION["total"] = $_SESSION["total"] + $precio;
    $cantidad = $row['cantidad'];
    $_SESSION["total"] = $_SESSION["total"] * $cantidad;
    $sql4 = "INSERT INTO compras (id_usuario, id_producto, nombre, descripcion, precio, foto, cantidad) VALUES ('$id', '$idproducto', '$nombre', '$descripcion', '$precio', '$foto', '$cantidad')";
    $result4 = mysqli_query($conexion, $sql4);
    
    //saque un alert de que se compro el producto
    echo '<script type="text/javascript">
    alert("Compra realizada con exito");
    </script>';
    header("Location: ../Comprafinalizada.php");
}
