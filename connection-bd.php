<?php
$link = 'mysql:host=localhost;dbname=crud';
$usuario = 'root';
$pass = '';

try {
    $pdo= new PDO($link, $usuario, $pass);

    // foreach($pdo->query('SELECT * from images') as $fila) {
    //     print_r($fila);
    // }
   

} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>