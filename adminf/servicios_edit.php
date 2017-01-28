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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE servicios SET servicio=%s, descripcion=%s, imagen=%s WHERE id=%s",
                       GetSQLValueString($_POST['servicio'], "text"),
                       GetSQLValueString($_POST['descripcion'], "text"),
                       GetSQLValueString($_POST['imagen'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_master, $master);
  $Result1 = mysql_query($updateSQL, $master) or die(mysql_error());

  $updateGoTo = "servicios_edit.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO galeria (id, imagen, id_serv) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['imagen'], "text"),
                       GetSQLValueString($_POST['id_serv'], "int"));

  mysql_select_db($database_master, $master);
  $Result1 = mysql_query($insertSQL, $master) or die(mysql_error());

  $insertGoTo = "servicios_edit.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_serv = "-1";
if (isset($_GET['id'])) {
  $colname_serv = $_GET['id'];
}
mysql_select_db($database_master, $master);
$query_serv = sprintf("SELECT * FROM servicios WHERE id = %s", GetSQLValueString($colname_serv, "int"));
$serv = mysql_query($query_serv, $master) or die(mysql_error());
$row_serv = mysql_fetch_assoc($serv);
$totalRows_serv = mysql_num_rows($serv);

$colname_galeria = "-1";
if (isset($_GET['id'])) {
  $colname_galeria = $_GET['id'];
}
mysql_select_db($database_master, $master);
$query_galeria = sprintf("SELECT * FROM galeria WHERE id_serv = %s ORDER BY id DESC", GetSQLValueString($colname_galeria, "int"));
$galeria = mysql_query($query_galeria, $master) or die(mysql_error());
$row_galeria = mysql_fetch_assoc($galeria);
$totalRows_galeria = mysql_num_rows($galeria);
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
				<h3 class="title1">EDIANDO SERVICIO</h3>
                
				<div class="blank-page widget-shadow scroll" id="style-2 div1">
                <table class="table">
  <tbody>
    <tr>
      <td width="27%" height="223" valign="top"><img src="../assets/images/servicios/<?php echo $row_serv['imagen']; ?>"  class="img-circle" width="200px"></td>
      <td align="center" valign="middle"><h3><?php echo $row_serv['servicio']; ?></h3><br><br> <?php echo $row_serv['descripcion']; ?></td>
      </tr>
  </tbody>
</table>
<a href="#" data-toggle="modal" data-target="#gridSystemModal" class="btn  btn-primary"> 
                    <i class="fa fa-pencil"></i> EDITAR SERVICIOS
                    </a>
                  <a href="#" data-toggle="modal" data-target="#gridSystemModal2" class="btn btn-success"> 
                    <i class="fa fa-pencil"></i> AGREGAR NUEVO IMAGEN A GALERIA
                    </a>
                    <a href="servicios.php" class="btn btn-default"> 
                    VOLVER A SERVICIOS
                    </a>
                    
                    
                    
                  <script>   function subirimagen()  {
				 self.name = 'opener';
				remote = open('subirimagen/subirimg_serv.php','remote','toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=100, width=1150, height=500'); 									  remote.focus();  }
 				</script>
                
                
                
                
           <div class="modal fade" id="gridSystemModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
							<div class=" modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        	<span aria-hidden="true">&times;</span>
                                        </button>
										<h4 class="modal-title" id="gridSystemModalLabel">EDITAR SERVICIO</h4>
									</div>
									<div class="modal-body">
	<form method="POST" action="<?php echo $editFormAction; ?>" name="form1">
		<div class="form-group form-inline">
			<input type="text" value="<?php echo $row_serv['imagen']; ?>" name="imagen" class="form-control" required  >
			<input type="button" class="btn btn-primary" name="button" id="button" value="Subir imagen" onclick="javascript:subirimagen();" /> 
		</div>
		<div class="form-group">
			<input type="text" value="<?php echo $row_serv['servicio']; ?>"  name="servicio" class="form-control"  >
		</div>
		<div class="form-group">
			<textarea type="text" value=""  name="descripcion" class="form-control" rows="7"  ><?php echo $row_serv['descripcion']; ?></textarea>
		</div>
		<input type="hidden" value="<?php echo $row_serv['id']; ?>" name="id" >
		<input type="submit" value="REGISTRAR" class="btn btn-block btn-success">
		<input type="hidden" name="MM_update" value="form1">
	
		
	</form>
                                    
	<div class="row-info">
                                      </div>  
										
									</div>
									
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
</div>


<script>   function subirimagen2()  {
				 self.name = 'opener';
				remote = open('subirimagen/subirimg_foto.php','remote','toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=100, width=1150, height=500'); 									  remote.focus();  }
 				</script>
                
                
                
           <div class="modal fade" id="gridSystemModal2" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
							<div class=" modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        	<span aria-hidden="true">&times;</span>
                                        </button>
										<h4 class="modal-title" id="gridSystemModalLabel">NUEVA FOTO A GALERIA</h4>
									</div>
									<div class="modal-body">
	<form method="POST" action="<?php echo $editFormAction; ?>" name="form2">
		<div class="form-group form-inline">
			<input type="text" value="" name="imagen" class="form-control" required  placeholder="Presione subir imagen">
			<input type="button" class="btn btn-primary" name="button" id="button" value="Subir imagen" onclick="javascript:subirimagen2();" /> 
		</div>
		
		
		<input type="hidden" value="" name="id" >
        <input type="hidden" value="<?php echo $row_serv['id']; ?>" name="id_serv" >
		<input type="submit" value="REGISTRAR" class="btn btn-block btn-success">
		<input type="hidden" name="MM_insert" value="form2">
		
		
	</form>
                                    
	<div class="row-info">
                                        </div>  
										
									</div>
									
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
</div>
       
       

  <br><br><hr>
  <h4 class="text-center">GALERIA DE <?php echo $row_serv['servicio']; ?> </h4>              
         <?php if ($row_galeria['id_serv']=="") { ?>
         No hay fotografias en este servicio
         <?php } else { ?>       
         
           <div class="row" >
           
           <?php do { ?> 
           
           <div class="col-lg-4 ">
           <div class=" img-thumbnail">
           <a href="servicios_gal_del.php?id=<?php echo $row_serv['id']; ?>&idgal=<?php echo $row_galeria['id']; ?>" class=" btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Eliminar</a>
           
           <img src="../assets/images/galeria/<?php echo $row_galeria['imagen']; ?>" width="100%" > 
           </div>
           </div>
           <?php } while ($row_galeria = mysql_fetch_assoc($galeria)); ?>
           </div>
           
<?php } ?>
                
                  
                
                   

                
                
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
mysql_free_result($serv);

mysql_free_result($galeria);
?>
