<?php
 include_once('clases/class.php');
 include_once('clases/secion.php');


if(isset($_POST['enviar']) and $_POST['enviar']!="")
{	

	$cat=new categoria;

	$cate=$cat->add_categoria($_POST['categoria']);
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Site made with Mobirise Website Builder v2.6.1, http://mobirise.com -->
  <meta charset="iso-8859-1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v2.6.1, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
  <meta name="description" content="">
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:700,400&amp;subset=cyrillic,latin,greek,vietnamese">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/animate.css/animate.min.css">
  <link rel="stylesheet" href="assets/mobirise/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  <link href="assets/bootstrap/css/stilacho.css" rel="stylesheet" type="text/css">
</head>
<body>
<section class="engine"><a rel="nofollow" href="index.php"></a></section>
<?php  include('vistas/cabeza.php'); ?>



<br>
<br>
<br>
<br>
<br>


<div class="container-fluid color-gris"  id="header1-3">
<br>

	

</div>


<br>
<br>

<section class="container" id="features1-5" style="background-color: rgb(255, 255, 255);">
  
    <div class="container">
       <div class="caption"><h1><strong class="label label-info text-center">AGREGAR CATEGORIAS</strong></h1></div>
       <br>
      
<br>

       
      <div class="container">
      		<form class="form-control" action="add_categoria.php" method="post">
            	<div class="form-group">
            		<input class="form-control color-gris text-white" name="categoria" type="text" placeholder="CATEGORIA">					                    
                </div>    
                
                
                	<input class="btn btn-primary" name="enviar" type="submit" value="GUARDAR">
                
                
            
            </form>

      
      </div>
    
    
    
    </div>
    
</section>









<?php include('vistas/rodapie.php'); ?>


<script src="assets/jquery/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smooth-scroll/SmoothScroll.js"></script>
  <script src="assets/jarallax/jarallax.js"></script>
  <script src="assets/mobirise/js/script.js"></script>
  
  
</body>
</html>