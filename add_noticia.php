<?php
 include_once('clases/class.php');

$cat=new categoria;
$cate=$cat->get_categoria();

if(isset($_POST['enviar']) and $_POST['enviar']!="")
{	



	$noti=new noticia;
	
	$noticia=$noti->add_noticia($_POST['titulo'],$_POST['detalle'],$_POST['imagen'],$_POST['fecha_cadena'],$_POST['descarga'],$_POST['id_categoria']);
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
<?php include('vistas/cabeza.php'); ?>



<br>
<br>
<br>
<br>
<br>




<br>
<br>

<section class="container" id="features1-5" style="background-color:#69F);">
  
    <div class="container">
       <div class="caption"><h1><strong class="label label-info text-center">AGREGAR NOTICIA</strong></h1></div>
       <br>
      
<br>

       
      <div class="container">
      		<form name="form1" id="form1" class="form-control" action="add_noticia.php" method="post">
            	<div class="form-group">
            		<input class="form-control color-blanco" name="titulo" type="text" placeholder="TITULO">		                    
                </div> 
                <br>
                <div class="form-group">
                <strong>ARTICULO</strong>
                <textarea class="form-control color-blanco" name="detalle" cols="500" rows="5">
                </textarea>
                        		
                </div> 
                <br>
                
                <div class="form-group col-lg-10">                    
                        <input class="form-control color-blanco" name="imagen" type="text" placeholder="IMAGEN">
                        
                </div>    
                <a onclick="javascript:subirimagen();" class="btn btn-danger">BUSCAR IMAGEN</a>
                <br>
                <div class="form-group">
            		<input class="form-control color-blanco " name="fecha_cadena" type="text" placeholder="FECHA PUBLICACION">					                    
                </div>    
                <br>
                <div class="form-group">
            		<input class="form-control color-blanco " name="descarga" type="text" placeholder="DESCARGAS">					                    
                </div>    
                <br>
                <div class="form-group">
                	<strong>CATEGORIA</strong>
            		<select name="id_categoria" class="form-control color-blanco">
                       <?php   for($i=0;$i<sizeof($cate);$i++)
							{
	 					?>
                    		<option  value="<?php echo $cate[$i]['id_cat'] ?>"><?php echo  strtoupper($cate[$i]['categoria'])?></option>
                    	<?php } ?>
                    </select>
                </div>    
                <br>
                
                
                
                
                
                	<input class="btn btn-primary" name="enviar" type="submit" value="GUARDAR">
                
                
            
            </form>

      
      </div>
    
    
    
    </div>
    
</section>









<?php include('vistas/rodapie.php'); ?>


 <script> 
 function subirimagen()
  {
	  self.name = 'opener';
	  remote = open('clases/subirimg.php','remote','toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=100, width=1150, height=500');
	  remote.focus();
	  
  }
  </script>


<script src="assets/jquery/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smooth-scroll/SmoothScroll.js"></script>
  <script src="assets/jarallax/jarallax.js"></script>
  <script src="assets/mobirise/js/script.js"></script>
  
  
</body>
</html>