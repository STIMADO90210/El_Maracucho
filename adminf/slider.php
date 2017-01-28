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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "slider_new")) {
  $insertSQL = sprintf("INSERT INTO slider (id, imagen, titulo, mensaje) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['imagen'], "text"),
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['mensaje'], "text"));

  mysql_select_db($database_master, $master);
  $Result1 = mysql_query($insertSQL, $master) or die(mysql_error());

  $insertGoTo = "slider.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE slider SET imagen=%s, titulo=%s, mensaje=%s WHERE id=%s",
                       GetSQLValueString($_POST['imagen'], "text"),
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['mensaje'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_master, $master);
  $Result1 = mysql_query($updateSQL, $master) or die(mysql_error());

  $updateGoTo = "slider.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_master, $master);
$query_slider = "SELECT * FROM slider";
$slider = mysql_query($query_slider, $master) or die(mysql_error());
$row_slider = mysql_fetch_assoc($slider);
$totalRows_slider = mysql_num_rows($slider);
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
				<h3 class="title1">ADMINISTRAR SLIDER</h3>
                
               	<a href="#" data-toggle="modal" data-target="#gridSystemModal" class="btn btn-lg btn-default">
                    <i class="fa fa-pencil"></i> AGREGAR NUEVO SLIDER 
              	</a><br><br>
                
				<div class="blank-page widget-shadow scroll" id="style-2 div1">


         <table class="table">
  <tbody>
    <tr class="active">
      <td width="8%"><strong>POSICIÓN</strong>&nbsp;</td>
      <td width="25%"><strong>IMAGEN</strong>&nbsp;</td>
      <td width="20%"><strong>TITULO</strong>&nbsp;</td>
      <td width="24%"><strong>MENSAJE</strong>&nbsp;</td>
      <td width="22%"><strong>ACCIONES</strong>&nbsp;</td>
    </tr>
    <?php if ($row_slider['id']=="") { ?>
    <tr> <td colspan="5"><p class="text-center">NO EXISTEN SLIDER REGISTRADOS</p></td></tr>
    <?php } else { ?>
    
    <?php $contador = 1 ?>
    <?php do { ?>
  <tr>
    <td><?php echo $contador ; ?>&nbsp;</td>
    <td><img src="../assets/images/slider/<?php echo $row_slider['imagen']; ?>" width="200px"></td>
    <td><?php echo $row_slider['titulo']; ?>&nbsp;</td>
    <td><?php echo $row_slider['mensaje']; ?>&nbsp;</td>
    <td>
    
    <a href="slider_edit.php?id=<?php echo $row_slider['id']; ?>"  class="btn btn-primary"><i class="fa fa-pencil"></i> Editar</a> 
    <a href="slider_del.php?id=<?php echo $row_slider['id']; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i> Eliminar </a>&nbsp;</td>
  </tr>
   <?php $contador ++ ?>
   <?php } while ($row_slider = mysql_fetch_assoc($slider)); ?>
   
   <?php } ?>
   
  </tbody>
</table>


<script>   function subirimagen()  {
				 self.name = 'opener';
				remote = open('subirimagen/subirimg_slider.php','remote','toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=100, width=1150, height=500'); 									  remote.focus();  }
 				</script>
                
                
                
                
           <div class="modal fade" id="gridSystemModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
							<div class=" modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        	<span aria-hidden="true">&times;</span>
                                        </button>
										<h4 class="modal-title" id="gridSystemModalLabel">REGISTRAR NUEVO SLIDER</h4>
									</div>
									<div class="modal-body">
	<form method="POST" action="<?php echo $editFormAction; ?>" name="form1">
		<div class="form-group form-inline">
			<input type="text" value="" name="imagen" class="form-control" required >
			<input type="button" class="btn btn-primary" name="button" id="button" value="Subir imagen" onclick="javascript:subirimagen();" /> 
		</div>
		<div class="form-group">
			<input type="text" value=""  name="titulo" class="form-control"  placeholder="Titulo">
		</div>
		<div class="form-group">
			<textarea type="text" value=""  name="mensaje" class="form-control" rows="7"  placeholder="Mensaje"></textarea>
		</div>
		<input type="hidden" value="" name="id" >
		<input type="submit" value="REGISTRAR" class="btn btn-block btn-success">
		<input type="hidden" name="MM_insert" value="slider_new">
	</form>
                                    
	<div class="row-info">
                                        </div>  
										
									</div>
									
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
</div>
             
                  

                
                
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
mysql_free_result($slider);

?>
