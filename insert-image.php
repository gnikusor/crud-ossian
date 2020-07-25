<?php

include_once( 'connection-bd.php' );

if($_POST){
        $titulo = $_POST['title'];
        $categoria = $_POST['category'];
        $urls = $_POST['url'];
        $descripcion = $_POST['description'];
      
      
        $sql_insertadatos="INSERT INTO images (title,category,urls,descriptions) VALUES (?,?,?,?)";
        
        $agrega = $pdo->prepare($sql_insertadatos);
        $agrega -> execute(array($titulo,$categoria,$urls,$descripcion));
        echo "Se han insertado los datos";
        header('Location:index.php');
        
}