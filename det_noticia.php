<?php
 include_once('clases/class.php');
 include_once('clases/secion.php');
	include_once('clases/funciones.php');
		
	// --------------------------
		$comenta= new comentario;	
	
	// --------------------------
	$cat= new categoria;
	// -------------------------
	$noti=new noticia;
	
	if(isset($_POST['come'])){
		$idnot=$_POST['id'];
	$articulo=$noti->get_noticia_id($_POST['id']);
	;
  	$comentario = $comenta->add_comentario($_POST['nombre'],$_POST['comenta'],$_POST['id']);
	
	}else{
		$idnot=$_GET['id'];
	$articulo=$noti->get_noticia_id($_GET['id']);	
	
	}
	if(isset($_POST['come']))
		{
			echo"<br>
<br>
<br><br>
<br>
";

			
		
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
 <?php  include('vistas/cabeza.php');  ?>


<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


<section class="container-fluid" id="caja" style="background-color:#FFF">

          

<div class="container color-azul">
<br>
<br>
		<div class="col-lg-4">
 						<div class="thumbnail">
                        
                           
                           		<img src="assets/images/<?php  echo $articulo[0]['imagen'] ?>">
                            
                        </div>
        </div>
        
        
        
        <div class=" col-lg-8">
        
        <h1 class="col-xs-offset-2 page-header"><span class="text-white text-uppercase"><?php  echo $articulo[0]['titulo']?></span></h1>
        <?php $cate=$cat->get_categoria_id($articulo[0]['id_categoria']);?>
        <p ><span class="col-xs-offset-2 page-header letra-amarilla text-uppercase"><?php  echo dia(date('N',strtotime($articulo[0]['fecha'])))." ".date('d',strtotime($articulo[0]['fecha']))." de ".mes(date('n',strtotime($articulo[0]['fecha'])))." de ".date('Y',strtotime($articulo[0]['fecha']));  ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $cate[0]['categoria']?></span></p>
        <br>
		<br>

        <p class="col-xs-offset-2 text-white text-justify"><?php  echo $articulo[0]['detalle']; ?></p>
 			<br>
		<br>	
        
        <p class="col-xs-offset-2"><a href="index.php" class="btn btn-danger">INICIO</a></p>		
        </div>   
        
<br>
<br>
<br>                     
</div>
<br>
<br>

</section>


<section class="container-fluid">
<div class="col-lg-4 color-rojo">
<br>
<br>

<form name="comentario" id="comentario" class="form-group" action="det_noticia.php" method="post">
<div class="form-group">
  <input class=" form-control" name="nombre" type="text" placeholder="NOMBRE">
</div>
<strong>COMENTARIOS</strong>
<div class="form-group">
  <textarea class="form-control" name="comenta" cols="50" rows="5">
</textarea>
</div>

<input name="come" type="submit" value="comentar">

<input name="id" type="hidden" value="<?php echo $idnot ?>">

</form>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php 
	$comentario=$comenta->get_comentario($idnot);
	$nro=count($comentario);
?>
<button class="btn btn-primary">     <h4>Total Comentarios    <span class="badge"><h5><?php echo $nro ?></h5></span></h4> </button>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

</div>





<?php // $comentario=$comenta->get_comentario($idnot);?>


<div class="col-lg-8 color-gris">
<br>
<br>
 
<br>
<br>
<br>

<?php  
$r=sizeof($comentario);
			if($r==0)
				{
				echo "<div class= ' panel-default color-azul '> <br> <br>";	
				echo "<div class= ' panel-heading '>";
				echo "<h2 class='text-center text-danger'>Noticia aun no tiene Comentarios<h2>";
				echo "</div><br><br></div>  <br>
<br>";	
				}else{
for($i=0;$i<sizeof($comentario);$i++)
{

	 ?>
  <div class=" panel-default color-azul">
  

 <div class="panel-heading">
 <table class="table table-condensed">
  <tr>
    <td ><?php echo  dia(date('N',strtotime($comentario[$i]['fecha'])))." ".date('d',strtotime($comentario[$i]['fecha']))." de ".mes(date('n',strtotime($comentario[$i]['fecha'])))." de ".date('Y',strtotime($comentario[$i]['fecha']));  ?></td>
    <td><?php echo  date('h:m:s a',strtotime($comentario[$i]['hora'])); ?></td>
  </tr>
</table>

 
 
 <h3 class="text-danger"><?php echo $comentario[$i]['nombre']?> </h3>
 </div> 
 <div class="panel-body">
  <p class="text-white"><?php echo $comentario[$i]['comenta'] ?></p>
  </div>
  
</div>
<br>
<br>
<?php } }?>
</section>


<br>
<br>
<br>




<?php include('vistas/rodapie.php'); ?>


<script src="assets/jquery/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smooth-scroll/SmoothScroll.js"></script>
  <script src="assets/jarallax/jarallax.js"></script>
  <script src="assets/mobirise/js/script.js"></script>
  
  
</body>
</html>