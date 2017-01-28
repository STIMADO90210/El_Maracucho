<?php
 include_once('clases/class.php');
	
	$cat=new categoria;

	$cate=$cat->get_categoria();
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

<section class="container" id="features1-5" style="background-color: rgb(255, 255, 255);">
  
    <div class="container">
       <div class="caption"><h1><strong class="label label-info text-center">CATEGORIAS</strong></h1></div>
       <br>
       <a href="add_categoria.php" class="btn btn-warning text-uppercase">Agregar Categoria</a>
       <br>
<br>

       
      <div class="container">
      		<table class="table table-responsive table-striped text-uppercase" >
                      <tr>
                        <td align="center" align="center">id</td>
                        <td align="center" align="center">categoria</td>
                        <td align="center" colspan="2">acciones</td>
                        
                      </tr>
                       <?php   for($i=0;$i<sizeof($cate);$i++)
{
	 ?>
                      <tr>
                        <td align="center"><?php echo $cate[$i]['id_cat'] ?></td>
                        <td align="center"><?php echo $cate[$i]['categoria'] ?></td>
                        <td width="19%" align="center"><a href="edita_cat.php?id=<?php echo $cate[$i]['id_cat'] ?>" class="btn btn-primary">Editar</a></td>
                        <td width="19%" align="center"><a href="javascript:eliminar()" onClick="window.location='elimina_cat.php?id=<?php echo $cate[$i]['id_cat'] ?>'" class="btn btn-danger" >Eliminar</a></td>
                        
                      </tr>
                      <?php }?>
		</table>

      <br>
<br>

      </div>
    
    
    
    </div>
    
</section>









<?php include('vistas/rodapie.php'); ?>



<script type='text/javascript'> 
	function eliminar()
	{
		if(confirm('Realmente Desea Eliminar Esta Categoria'))
		{
		}else{
			window.location='categorias.php';
			}
	}
</script>



<script src="assets/jquery/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smooth-scroll/SmoothScroll.js"></script>
  <script src="assets/jarallax/jarallax.js"></script>
  <script src="assets/mobirise/js/script.js"></script>
  
  
</body>
</html>