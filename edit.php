<?php 

//RECOGEMOS LOS DATOS DE LA URL Y LO ACTUALIZAMOS EN LA BASE DE DATOS
$id=$_GET['id'];
$titulo = $_GET['title'];
$categoria = $_GET['category'];
$enlace = $_GET['url'];
$descripcion = $_GET['description'];


//INCLUIMOS LA CONEXION DE LA BASE DE DATOS
include_once("connection-bd.php");


$sql_editar= 'UPDATE images SET title=?,category=?,urls=?,descriptions=? WHERE id=?';
$sentencia_editar= $pdo->prepare($sql_editar);
$sentencia_editar->execute(array($titulo,$categoria,$enlace,$descripcion,$id));

//REDIRIGIMOS AL INDEX
header('Location: index.php');

