<?php
//eliminar la Cantidad que hay en en select del carrito
include("./conexion.php");
$idtodo = $_POST["id"];
$cantidad = $_POST["cantidad"];
$sql = "SELECT * FROM carrito WHERE id = '$idtodo'";
$result = mysqli_query($conexion, $sql);
$row = mysqli_fetch_array($result);
$cantidad2 = $row['cantidad'];
if($cantidad == $row['cantidad']){
    $sqleliminar = "DELETE FROM carrito WHERE id = '$idtodo'";
    $resulteliminar = mysqli_query($conexion, $sqleliminar);
}else{
    $cantidad2 = $cantidad2 - $cantidad;
    $sql2 = "UPDATE carrito SET cantidad = '$cantidad2' WHERE id = '$idtodo'";
    $result2 = mysqli_query($conexion, $sql2);

}



if ($result) {
    echo '<script>alert("Producto eliminado del carrito")</script>';
    echo '<script>window.location="../carrito.php"</script>';
} else {
    echo '<script>alert("Error al eliminar el producto")</script>';
}
?>