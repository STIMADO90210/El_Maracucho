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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO usuario (id, nombre, apellido, email, password, imagen, nivel) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apellido'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['imagen'], "text"),
                       GetSQLValueString($_POST['nivel'], "int"));

  mysql_select_db($database_master, $master);
  $Result1 = mysql_query($insertSQL, $master) or die(mysql_error());

  $insertGoTo = "usuario.php?reg=1";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_master, $master);
$query_user_all = "SELECT * FROM usuario ORDER BY id DESC";
$user_all = mysql_query($query_user_all, $master) or die(mysql_error());
$row_user_all = mysql_fetch_assoc($user_all);
$totalRows_user_all = mysql_num_rows($user_all);
?>
<?php require_once('../Connections/master.php'); //initialize the session
if (!isset($_SESSION)) {
  session_start();
}
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
			
            
            
            
            <div class="row">
						<h3 class="title1">ADMINISTAR USUARIO </h3>
                        
                           <a href="#" data-toggle="modal" data-target="#gridSystemModal" class="btn btn-lg btn-default">
                    <i class="fa fa-pencil"></i> REGISTRAR USUARIO 

              </a>
                        
						<div class="form-three widget-shadow">
                        
                        
                         <?php if ((isset($_GET['del'])) && ($_GET['del'] == 1)) {?>
                <div class="alert alert-info">
                	Usuario fue eliminado exitosamente
                		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  							<span aria-hidden="true">&times;</span>
						</button>
				</div>
                <?php }?>
                 <?php if ((isset($_GET['reg'])) && ($_GET['reg'] == 1)) {?>
                <div class="alert alert-success">
                	Usuario fue registrado exitosamente
                		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  							<span aria-hidden="true">&times;</span>
						</button>
				</div>
                <?php }?>
                 
         
                <?php if ($row_user_all['id']=="") { ?>
						<div class="alert alert-dismissable alert-info" >No hay usuarios registrados</div>
						<?php } else { ?>
                  
                  <table class="table table-hover table-striped">
                    <tr class="active">
                    	
                      <td width="25%"><strong>NOMBRE Y APELLIDO &nbsp;</strong></td>
                      <td width="30%"><strong>CORREO&nbsp;</strong></td>
                      <td width="8%"><strong>ACCESO&nbsp;</strong></td>
                      <td width="19%"><strong>ACCIONES&nbsp;</strong></td>
                        
                    </tr>
                    <?php do { ?>
  <tr>

    <td>
      <h4> <?php echo $row_user_all['nombre']; ?> <?php echo $row_user_all['apellido']; ?> &nbsp; </h4>
    </td>
    <td>
      <h4> <?php echo $row_user_all['email']; ?> &nbsp; </h4>
    </td>
    <td>
      <h4>
	  	<?php if ($row_user_all['nivel']==1) { ?> Administrador <?php } ?> 
        <?php if ($row_user_all['nivel']==2) { ?> Regular <?php } ?>
        <?php if ($row_user_all['nivel']==3) { ?> Doctor <?php } ?>
       </h4>
    </td>
    <td>
      <a href="perfil_edit.php?id=<?php echo $row_user_all['id']; ?>&adm=1" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Editar</a> 
      <a href="usuario_del.php?id=<?php echo $row_user_all['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Eliminar</a>
    </td>
  </tr>
  <?php } while ($row_user_all = mysql_fetch_assoc($user_all)); ?>
                    </table>
            <?php } ?>       
                        
                         
                        </div>
   			</div>
            
            
            
	  </div>
      
      
      <div class="modal fade" id="gridSystemModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
							<div class=" modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        	<span aria-hidden="true">&times;</span>
                                        </button>
										<h4 class="modal-title" id="gridSystemModalLabel">REGISTRAR NUEVO USUARIO</h4>
									</div>
									<div class="modal-body">
										<div class="row-info">
                                          <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
                                            <table class="table">
                                               <tr valign="baseline">
                                                <td nowrap align="right">Nombre:</td>
                                                <td><input type="text" name="nombre" value="" required class="form-control"></td>
                                              </tr>
                                              <tr valign="baseline">
                                                <td nowrap align="right">Apellido:</td>
                                                <td><input type="text" name="apellido" value="" required class="form-control"></td>
                                              </tr>
                                              <tr valign="baseline">
                                                <td nowrap align="right">Email:</td>
                                                <td><input type="text" name="email" value="" required class="form-control"></td>
                                              </tr>
                                              <tr valign="baseline">
                                                <td nowrap align="right">Password:</td>
                                                <td><input type="text" name="password" value="" required class="form-control"></td>
                                              </tr>
                                              <tr valign="baseline">
                                                <td nowrap align="right">Acceso:</td>
                                                <td><select name="nivel" required class="form-control">
                                                  <option value="" >Seleccione una Opcion</option>
                                                  <option value="1" >Administrador</option>
                                                  <option value="3" >Doctor</option>
                                                  <option value="2">Regular</option>
                                                </select></td>
                                              </tr>
                                              <tr valign="baseline">
                                                <td nowrap align="right">&nbsp;</td>
                                                <td><input type="submit" value="REGISTRAR" class="btn btn-success"></td>
                                              </tr>
                                            </table>
                                            <input type="hidden" name="id" value="">
                                            <input type="hidden" name="imagen" value="avatar_default.png">
                                            <input type="hidden" name="MM_insert" value="form1">
                                          </form>
                                          <p>&nbsp;</p>
<p>&nbsp;</p>
                                        
                                          <p>&nbsp;</p>
                                        </div>  
										
									</div>
									
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
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
mysql_free_result($user_all);
?>
