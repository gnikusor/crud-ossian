<?php
//INCLUIMOS LA CONEXION DE LA BASE DE DATOS  
include_once( 'connection-bd.php' );

//SELECCIONAMOS TODO DE IMAGES Y LO GUARDAMOS
$sql_leer='SELECT * FROM images';

$gsent = $pdo->prepare($sql_leer);
$gsent -> execute();

$resultado = $gsent -> fetchAll();

// SI EL METODO GET ESTÁ ACTIVO, COGEMOS LA ID
if($_GET){

      $id=$_GET['id'];

      $sql_unico='SELECT * FROM images WHERE id=?';

      $gsent_unico = $pdo->prepare($sql_unico);
      $gsent_unico -> execute(array($id));

      $resultado_unico = $gsent_unico -> fetch();    
 }


?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- Hoja de estilos css -->
    <link rel="stylesheet" href="style.css">
    <!-- Iconos Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fuentes de Google -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">

    <title>Ghiorghita Nicusor Necula</title>
</head>

<body>


    <div class="container-fluid" >

        <div class="row text-center bg-dark p-3">
            <div class="col-12">
                <a href="index.php">
                    <h1 style="font-family: 'Dancing Script', cursive;">CRUD Ossian Technology</h1>
                </a>

            </div>



    </div>


    <div class="row py-2 ">
            <div class="col-12 float-right">

                <a href="delete-all.php" class="float-right m-3"><button class="btn btn-outline-danger btn-sm "
                onclick="alert('Se ha eliminado toda la base de datos.');"     title="Eliminar toda la base de datos">DELETE DATABASE</button></a>

                <a href="connection-api.php" class="float-right m-3"><button class="btn btn-outline-secondary btn-sm"
                onclick="alert('Se han añadido datos desde la API de OSSIAN TECHNOLOGY.');"    title="Cargar API en la base de datos">LOAD API </button></a>

            </div>
    </div>


    <div class="row mb-lg-5">

            <?php if(!$_GET): ?>

            <div class="col-lg-8 col-sm-9 mx-auto">


                <form method="POST" action="insert-image.php" onsubmit="alert('Imagen insertada en la base de datos. \n Si la url no es correcta, no se va a visualizar.');">

                    <h2 class="text-center">INSERT NEW IMAGE</h2>
                    <input type="text" class="form-control mb-2" placeholder="Title..." name="title" required autofocus>
                    <input type="text" class="form-control mb-2" placeholder="Category..." name="category" required >
                    <input type="text" class="form-control mb-2" placeholder="Url-Image..." name="url" required >
                    <textarea type="text" class="form-control mb-2" rows="5" cols="5" placeholder="Description..." name="description" required></textarea>
                    <button type="submit" class="btn btn-outline-secondary btn-lg col-12 text-center" title="Añadir imagen a la base de datos" >INSERT</button>

                </form>


            </div>



            <?php endif ?>


            <?php if($_GET): ?>


                <div class="col-lg-8 col-sm-9 mx-auto">


                    <form method="GET" action="edit.php" id="editar" onsubmit="alert('Los datos han sido modificados.');">

                        <h2 class="text-center">UPDATE IMAGE</h2>
                        <input type="text" class="form-control mb-2" name="title"
                            value="<?php echo $resultado_unico['title'] ?>" required>
                        <input type="text" class="form-control mb-2" name="category"
                            value="<?php echo $resultado_unico['category'] ?>" required>
                        <input type="text" class="form-control mb-2" name="url"
                            value="<?php echo $resultado_unico['urls'] ?>" required>
                        <textarea class="form-control mb-2" name="description" rows="5" cols="5"
                            value="<?php echo $resultado_unico['descriptions'] ?>"
                            required><?php echo $resultado_unico['descriptions'] ?>  </textarea>
                        <input type="hidden" name='id' value="<?php echo $resultado_unico['id'] ?>">

                        <button type="submit" class="btn btn-outline-secondary btn-lg col-12 text-center">UPDATE</button>

                    </form>

                </div>


            <?php endif ?>


        </div>






        <div class="row text-center">

            <?php foreach($resultado as $dato): ?>
            <div class="col-sm-2 col-lg-5 p-4 mt-4 mb-5 bg-info mx-auto" id="fotos" style="font-family: 'Dancing Script', cursive; font-family: 'Josefin Sans', sans-serif; text-align:justify;">


                <a href="delete.php?id=<?php echo $dato['id'] ?>" onclick="alert('Elemento eliminado.');" class="float-right m-1"
                    title="Eliminar <?php echo $dato['title'] ?>">
                    <i class="fa fa-times" style="font-size:23px;"></i>
                </a>

                <a href="index.php?id=<?php echo $dato['id'] ?>" class="float-right m-1">
                    <i class="fa fa-pencil" aria-hidden="true" title="Editar <?php echo $dato['title'] ?>"
                        style="font-size:21px;"></i>
                </a>



                <div class="float-left">
                    <span class="text-uppercase">Title</span>: <?php echo $dato['title'] ?> <br>
                    <span class="text-uppercase"> Category</span>: <?php echo $dato['category'] ?>
                </div><br><br><br>

                <a href="<?php echo $dato['urls']?>" target="_blank" title="Ver imagen">
                    <img src="<?php echo $dato['urls']?>" alt="image" id="img">
                </a><br />



                <br><span class="text-uppercase"> Description</span>:<br> <?php echo $dato['descriptions'] ?>
            </div>
            <?php endforeach ?>


        </div>




        <!-- Footer -->
        <footer class="row font-small bg-dark text-white text-center p-1 fixed-bottom">


            <div class="col-lg-12">
              <strong>  © <?php echo date('Y') ?></strong>
                <a href="index.php" style="color:white; font-weight:bold;"> CRUD Geo Necula</a>

                <div class="float-right mr-5">

                    <a href="https://www.facebook.com/geo.necula/" target="_blank" style="font-size:17px; "
                        title="Facebook" class="m-1">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>

                    <a href="https://www.linkedin.com/in/gnikusor/" target="_blank" title="Linkedin" class="m-1">
                        <i class="fa fa-linkedin " aria-hidden="true"></i>
                    </a>

                    <a href="https://twitter.com/GeoNecula" target="_blank" title="Twitter" class="m-1">
                        <i class="fa fa-twitter " aria-hidden="true"></i>
                    </a>

                </div>
              </div>





              </div>

        </footer>
    <!-- Footer -->



    </div>



    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>