<?php
 include_once('clases/class.php');
 include_once('clases/secion.php');
 include_once('clases/funciones.php');
	//******************************
	 if(isset($_GET['cat'])){ $nro= $_GET['cat']; }else{ $nro=0; }
	//******************************
	$cat=new categoria;
	
	//******************************
	$noti=new noticia;
	if($nro==0){
		$articulo=$noti->get_noticia();
	}else{
		
		$articulo=$noti->get_noticia_cat($nro);
		
		
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
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:7$i$i,4$i$i&amp;subset=cyrillic,latin,greek,vietnamese">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/animate.css/animate.min.css">
  <link rel="stylesheet" href="assets/mobirise/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  <link href="assets/bootstrap/css/stilacho.css" rel="stylesheet" type="text/css">
  
  
  <!-- Start WOWSlider.com HEAD section -->
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
<script type="text/javascript" src="engine1/jquery.js"></script>
<!-- End WOWSlider.com HEAD section -->
</head>
<body>
<section class="engine"><a rel="nofollow" href="index.php"></a></section>
<?php  include('vistas/cabeza.php'); ?>


<br>
<br><br>
<br>
<br>
<br>
 <div class="thumbnail mbr-box--adapted" >
 <!-- Start WOWSlider.com BODY section -->
<div id="wowslider-container1">
<div class="ws_images"><ul>
		<li><img src="data1/images/sl1.jpg" alt="" title="" id="wows1_0"/></li>
		<li><a href="http://wowslider.com/vi"><img src="data1/images/sl2.jpg" alt="bootstrap slider" title="" id="wows1_1"/></a></li>
		<li><img src="data1/images/sl3.jpg" alt="" title="" id="wows1_2"/></li>
	</ul></div>
	<div class="ws_bullets"><div>
		<a href="#" title=""><span><img src="data1/tooltips/sl1.jpg" alt=""/>1</span></a>
		<a href="#" title=""><span><img src="data1/tooltips/sl2.jpg" alt=""/>2</span></a>
		<a href="#" title=""><span><img src="data1/tooltips/sl3.jpg" alt=""/>3</span></a>
	</div></div><div class="ws_script" style="position:absolute;left:-99%"><a href="http://wowslider.com">slideshow html</a> by WOWSlider.com v8.2</div>
<div class="ws_shadow"></div>
</div>	
<script type="text/javascript" src="engine1/wowslider.js"></script>
<script type="text/javascript" src="engine1/script.js"></script>
<!-- End WOWSlider.com BODY section -->
    </div>
    <br>
<br>


<div class="container row">
  
  <div class="container col-lg-3 col-md-12 color-rojo ">
    <br>
<br>
    <aside>
    
    <?php $cate=$cat->get_categoria();?>
    <div class="col-xs-offset-1 text-white">
      
      <a href="index.php" class="text-white">EL MARACUCHO</a>
      <br>

      <span>Las Noticias de Maracaibo</span>
    </div>
    <div class="nav navbar-nav navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>				
      <ul class="nav nav-pills nav-stacked " >
      <li role="presentation"><a class="text-white" href="index.php?cat=0">RESUMEN</a></li>
       <?php   for($i=0;$i<sizeof($cate);$i++)
{
	 ?>
          
        <li role="presentation"><a class="text-white" href="index.php?cat=<?php echo $cate[$i]['id_cat'] ?>"><?php echo $cate[$i]['categoria'] ?></a></li>
        <li class="divider"></li>
        <?php }?>
       
        </ul>	
    
    <br>
<br>  
      </div>
    
    
    
  </aside>
  </div>
 

  
  <div class="col-lg-9 col-md-12">
  
  
    <?php   for($i=0;$i<sizeof($articulo);$i++)
{
	 ?>
    
    
  <div class="container color-azul">
  <br>
  <br>
    <div class="col-lg-4">
      <div class="thumbnail">
        
        
        <img src="assets/images/<?php  echo $articulo[$i]['imagen'] ?>">
        
        </div>
      </div>
    
    
    
    <div class=" container-fluid">
      
      <h1 class=" page-header"><span class="text-white"><?php  echo $articulo[$i]['titulo']?></span></h1>
      
      <?php
	   $cat=new categoria;
	   $cate=$cat->get_categoria_id($articulo[$i]['id_categoria']);?>
      <p ><span class="col-xs-offset-2 page-header letra-amarilla text-uppercase"><?php  echo dia(date('N',strtotime($articulo[$i]['fecha'])))." ".date('d',strtotime($articulo[$i]['fecha']))." de ".mes(date('n',strtotime($articulo[$i]['fecha'])))." de ".date('Y',strtotime($articulo[$i]['fecha']));  ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<spam class="text-left text-danger "><?php  echo $cate[0]['categoria']?></spam></span></p>
      <br>
      <br>
      
      <p class=" text-white text-justify"><?php  echo substr($articulo[$i]['detalle'],0,250); ?></p>
      <br>
      <br>	
      
      <p class=""><a href="det_noticia.php?id=<?php  echo $articulo[$i]['id_not'] ?>" class="btn btn-danger">LEER MAS</a></p>		
      </div>   
    
  </div>
  <br>
  <br>
  <?php } ?>
  </div>
  
  
  
</div>







<section class="mbr-section" id="header3-7">
    <div class="mbr-section__container container mbr-section__container--first">
        <div class="mbr-header mbr-header--wysiwyg row">
            <div class="col-sm-8 col-sm-offset-2">
                <h3 class="mbr-header__text">EL MARACUCHO.COM</h3>
                <p class="mbr-header__subtext">SUSCRIBETE Y ENTRA EN SECCION PARA DISFRUTAR DE MAS OPCIONES DE INFORMACION</p>
            </div>
        </div>
    </div>
</section>

<section class="mbr-section" id="buttons1-8">
    <div class="mbr-section__container container mbr-section__container--last">
   <?php  if(!isset($_SESSION['nombre'])){ ?>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
			
		
<div class="mbr-buttons mbr-buttons--center"><a class="mbr-buttons__btn btn btn-lg btn-danger" href="login.php">INICIAR SECCION</a> <a class="mbr-buttons__btn btn btn-lg btn-default" href="index.php">REGISTRARSE</a></div>
            </div>
        </div>
        <?php }?>
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