<?php


try{
//SOLICITAMOS DATOS Y LOS GUARDAMOS EN FORMATO JSON
$data = json_decode(file_get_contents('http://internal.ossian.tech/api/Sample'),true);
}catch(Exception $e){
  echo 'Error !!, los datos no se han podido conseguir de la API <br>',$e->getMessage();
}



//RECORREMOS EL OBJETO OBTENIDO Y LO GUARDAMOS
foreach($data as $valor){
  $datos=$valor;
}


//AGREGAMOS LA CONEXION A LA BASE DE DATOS
include_once( 'connection-bd.php' );

//RECORREMOS EL ARRAY $datos
for($i=0; $i < count($datos); $i++){
 
      //GUARDAMOS LOS DATOS Y LOS INSERTAMOS
      $titulo= $datos[$i]['title'];
      $categoria= $datos[$i]['category'];
      $enlace= $datos[$i]['url'];
      $descripcion= $datos[$i]['description'];
    
                $sql_insertadatos="INSERT INTO images (title,category,urls,descriptions) VALUES (?,?,?,?)";
 
                $agrega = $pdo->prepare($sql_insertadatos);
                $agrega -> execute(array($titulo,$categoria,$enlace,$descripcion));
      
} 


header('Location:index.php');

