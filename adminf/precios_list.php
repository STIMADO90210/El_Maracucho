<?php require_once('../Connections/master.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
 
$reg_user = "0";
if (isset($_SESSION['MM_id'])) {
  $reg_user = $_SESSION['MM_id'];
}
mysql_select_db($database_master, $master);
$query_user = sprintf("SELECT * FROM usuario WHERE usuario.id=%s", $reg_user);
$user = mysql_query($query_user, $master) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);

mysql_select_db($database_master, $master);
$query_precios = "SELECT * FROM precios";
$precios = mysql_query($query_precios, $master) or die(mysql_error());
$row_precios = mysql_fetch_assoc($precios);
$totalRows_precios = mysql_num_rows($precios);
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Admin Panel ::</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Novus Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
 <!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts--> 
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->
</head> 
<body class="cbp-spmenu-push">

<!--MODAL-->

<div class="modal fade" id="precios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">CONFIRMACIÓN</h4>
      </div>
      <div class="modal-body">
       ¿Esta seguro que desea vaciar todo el contenido de la tabla precios?<br>
       Si es asi precione borrar, sino precione cancelar.
      </div>
      <div class="modal-footer">
        <a class="btn btn-danger" href="precios_del.php" >BORRAR</a>
        <button type="button" class="btn btn-primary" data-dismiss="modal">CANCELAR</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="precios2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">IMPORTAR PRECIOS</h4>
      </div>
      <div class="modal-body">
       <?php include('importar.php'); ?>
      </div>
      <div class="modal-footer"><small><b>NOTA:</b> recuerde que el archivo que contiene los precios deben estar en excel en formato CSV</small></div>
      
    </div>
  </div>
</div>
<!--FIN MODAL-->
	<div class="main-content">
		<!--left-fixed -navigation-->
		<?php include("menu.php"); ?>
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		<?php include("header.php"); ?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
				<h3 class="title1">PRECIOS MEDISUR</h3>
				<div class="blank-page widget-shadow scroll" id="style-2 div1">
                
                
              <a  class="btn btn-danger" data-toggle="modal" data-target="#precios" >BORRAR PRECIOS</a>
<a  class="btn btn-primary" data-toggle="modal" data-target="#precios2" >AGREGAR PRECIO</a>
<hr>
<p>Para actualiar precios dede borrar precios primero, luego agregar los nuevos precios.</p>
<?php if ($totalRows_precios=="") {} else { ?>
<p>Precios actualizados: <?php echo date("d M Y", strtotime($row_precios['fecha'])); ?> </p>
<?php } ?>
<table class="table table-hover table-striped">
  <tbody>
    <tr class="active"> 
      <td><strong>ID&nbsp;</strong></td>
      <td><strong>NOMBRE UNIDAD&nbsp;</strong></td>
      <td><strong>CODIGO DE SERVICIO&nbsp;</strong></td>
      <td><strong>NOMBRE&nbsp;</strong></td>
      <td><strong>PRECIO&nbsp;</strong></td>
    </tr>
    <?php if ($totalRows_precios=="") { ?>
    <tr><td colspan="5" align="center"> NO HAY PRECIOS REGISTRADO</td></tr>
    <?php } else { ?>
    
    
    <?php do { ?>
      <tr>
        <td><?php echo $row_precios['id']; ?>&nbsp;</td>
        <td><?php echo $row_precios['nomuni']; ?>&nbsp;</td>
        <td><?php echo $row_precios['cod_serv']; ?>&nbsp;</td>
        <td><?php echo $row_precios['nombre']; ?>&nbsp;</td>
        <td><?php echo $row_precios['precio3']; ?>&nbsp;</td>
      </tr>
      <?php } while ($row_precios = mysql_fetch_assoc($precios)); ?>
      <?php } ?>
  </tbody>
</table>
                
              </div>
		</div>
        </div>
	
		 <?php include("footer.php"); ?>
    
	</div>
	<!-- Classie -->
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			

			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.js"> </script>
</body>
</html>

<?php
mysql_free_result($precios);
?>
