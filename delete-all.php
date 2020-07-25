<?php

include_once('connection-bd.php');


$sql_eliminar_todo= 'DELETE FROM images';
$sentencia_eliminar_todo = $pdo->prepare($sql_eliminar_todo);
$sentencia_eliminar_todo->execute();

header('Location:index.php');



