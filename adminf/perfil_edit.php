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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE usuario SET nombre=%s, apellido=%s, email=%s, password=%s, nivel=%s WHERE id=%s",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apellido'], "text"),
					   GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['nivel'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_master, $master);
  $Result1 = mysql_query($updateSQL, $master) or die(mysql_error());

  $updateGoTo = "perfil_edit.php?edit=1";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE usuario SET imagen=%s WHERE id=%s",
                       GetSQLValueString($_POST['imagen'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_master, $master);
  $Result1 = mysql_query($updateSQL, $master) or die(mysql_error());

  $updateGoTo = "perfil_edit.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_usuario = "-1";
if (isset($_GET['id'])) {
  $colname_usuario = $_GET['id'];
}
mysql_select_db($database_master, $master);
$query_usuario = sprintf("SELECT * FROM usuario WHERE id = %s", GetSQLValueString($colname_usuario, "int"));
$usuario = mysql_query($query_usuario, $master) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);
?>
<?php require_once('../Connections/master.php'); //initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Admin Panel | Home ::</title>
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
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->
<!--Calender-->
<link rel="stylesheet" href="css/clndr.css" type="text/css" />
<script src="js/underscore-min.js" type="text/javascript"></script>
<script src= "js/moment-2.2.1.js" type="text/javascript"></script>
<script src="js/clndr.js" type="text/javascript"></script>
<script src="js/site.js" type="text/javascript"></script>
<!--End Calender-->
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
				<h3 class="title1">Editando Perfil</h3>
				<div class="blank-page widget-shadow scroll" id="style-2 div1">
                    <div class=" col-lg-12">                
                    	
                        
                        
                
                
                
                
                
                           <div class="modal fade" id="gridSystemModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
							<div class=" modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        	<span aria-hidden="true">&times;</span>
                                        </button>
										<h4 class="modal-title" id="gridSystemModalLabel">CAMBIAR FOTO DE PERFIL</h4>
									</div>
									<div class="modal-body">
                                    <script>   function subirimagen()  {
				 self.name = 'opener';
				remote = open('subirimagen/subirimg_pic.php','remote','toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=100, width=1150, height=500'); 									  remote.focus();  }
 				</script>
                                    
                                    <form action="<?php echo $editFormAction; ?>" method="POST" name="form1">
		<div class="form-group form-inline">
                                    
                                    	
	<input type="text" value="<?php echo $row_usuario['imagen']; ?>" name="imagen" class="form-control" required readonly>
			<input type="button" class="btn btn-primary" name="button" id="button" value="Subir imagen" onclick="javascript:subirimagen();" /> 
                                        </div>
                                        <input type="submit" value="GUARDAR" class="btn btn-success btn-block">
                                        <input type="hidden" name="id" value="<?php echo $row_usuario['id']; ?>" >
                                        <input type="hidden" name="MM_update" value="form1">
                                      
                
                						</form>
                                        
                                        
									<div class="row-info">
                                        </div>  
										
									</div>
									
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
							</div>
                <a href="#" data-toggle="modal" data-target="#gridSystemModal" >
                        
                        <img src="../assets/images/perfil/<?php echo $row_usuario['imagen']; ?>" class="img-circle img-thumbnail " width="150px" height="150px">
                        </a>
                        <hr>
                
                    
                    </div>
                    <div class="col-lg-12">
                    <?php if (isset($_GET['edit'])==1) { ?>
                    <div class="alert alert-info">Usuario se ha actualizado correctamente</div>
                    <?php } ?>
                    
                      <form action="<?php echo $editFormAction; ?>" method="POST" name="form2">
                        <table width="802" height="377" align="center">

                          
                          <tr valign="baseline">
                            <td width="83" align="right" nowrap>Nombre: &nbsp;</td>
                            <td width="707"><input type="text" class="form-control" name="nombre" value="<?php echo htmlentities($row_usuario['nombre'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">Apellido: &nbsp;</td>
                            <td><input type="text" name="apellido" class="form-control" value="<?php echo htmlentities($row_usuario['apellido'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">Email: &nbsp;</td>
                            <td><input type="text" name="email" class="form-control" readonly value="<?php echo htmlentities($row_usuario['email'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">Clave: &nbsp;</td>
                            <td><input type="text" name="password" class="form-control" value="<?php echo htmlentities($row_usuario['password'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                          </tr>
                         
                          <tr valign="baseline">
                            <td height="36" align="right" nowrap>Acceso: &nbsp;</td>
                            <td>

                            <?php if ($_GET['adm']==1) { ?> 
                            <select name="nivel" class="form-control">
                              <option value="1" <?php if ($row_usuario['nivel']==1) {echo "SELECTED";} ?> >Administrador</option>
                              <option value="2" <?php if ($row_usuario['nivel']==2) {echo "SELECTED";} ?> >Regular</option>
                              <option value="3" <?php if ($row_usuario['nivel']==3) {echo "SELECTED";} ?> >Doctor</option>
                            </select>
                            <?php } else { ?>
                            <input name="nivel" class="form-control" value="Doctor" value="<?php echo $row_usuario['nivel']; ?>" readonly >
                            <?php } ?>
                            
                            
                            </td>
                          <tr>
                          <tr valign="baseline">

                          <tr>
                          <tr valign="baseline">
                            <td height="38" align="right" nowrap>&nbsp;</td>
                            <td><input type="submit" value="Actualizar Perfil" class="btn btn-primary"> <a href="index.php" class="btn btn-default" >Salir</a></td>
                          </tr>
                        </table>
                        <input type="hidden" name="id" value="<?php echo $row_usuario['id']; ?>">
                        <input type="hidden" name="MM_update" value="form2">
                      </form>
                      <p>&nbsp;</p>
                    </div>
                                       
                    
 					<div class="clearfix"></div>
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
mysql_free_result($usuario);
?>
