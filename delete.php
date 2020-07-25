<?php

include_once('connection-bd.php');

$id=$_GET['id'];

$sql_eliminar= 'DELETE FROM images WHERE id=?';
$sentencia_eliminar = $pdo->prepare($sql_eliminar);
$sentencia_eliminar->execute(array($id));

header('Location:index.php');

