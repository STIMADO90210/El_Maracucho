<?php
 include_once('clases/class.php');
 include_once('clases/secion.php');
$user= new usuario;

if(isset($_POST['enviar']) and $_POST['enviar']!="")
{	

	$usuario=$user->get_usuario_validar($_POST['email'],$_POST['pass']);
	
	if(count($usuario)!=0)
	{
		
								$_SESSION['email'] = $usuario[0]['email'];
								$_SESSION['nombre'] = $usuario[0]['nombre'];
								$_SESSION['id_user'] = $usuario[0]['id_usuario'];
								$_SESSION['nivel'] = $usuario[0]['nivel'];
								
					
		?>			
					<script type='text/javascript'> 
							alert('Bienvenido al Sistema ');
							window.location='index.php';
					 </script>;
		 <?php 
		 }
        
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
       <div class="caption"><h1><strong class="label label-info text-center">Iniciar Seccion</strong></h1></div>
     
<br>
<div class="container">
  <div class=" col-lg-6">
    <form class="form-control" action="login.php" method="post">
      <div class="form-group">
        <input class="form-control color-gris text-white" name="email" type="text" placeholder="EMAIL">					                    
        </div> 
      <div class="form-group">
        <input class="form-control color-gris text-white" name="pass" type="text" placeholder="CLAVE">					                    
        </div>    
      
      
      
      <input class="btn btn-primary" name="enviar" type="submit" value="ENTRAR">
      
      
      
      </form>
    
    
  </div>
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