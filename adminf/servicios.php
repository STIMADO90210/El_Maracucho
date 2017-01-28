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
  $insertSQL = sprintf("INSERT INTO servicios (id, servicio, descripcion, imagen) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['servicio'], "text"),
                       GetSQLValueString($_POST['descripcion'], "text"),
                       GetSQLValueString($_POST['imagen'], "text"));

  mysql_select_db($database_master, $master);
  $Result1 = mysql_query($insertSQL, $master) or die(mysql_error());

  $insertGoTo = "servicios.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_master, $master);
$query_serv = "SELECT * FROM servicios";
$serv = mysql_query($query_serv, $master) or die(mysql_error());
$row_serv = mysql_fetch_assoc($serv);
$totalRows_serv = mysql_num_rows($serv);
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
				<h3 class="title1">SERVICIOS REGISTADOS</h3>
                
                	<a href="#" data-toggle="modal" data-target="#gridSystemModal" class="btn btn-lg btn-default"> 
                    <i class="fa fa-pencil"></i> AGREGAR NUEVO SERVICIO
                    </a>
                
                <br><br>
                
				<div class="blank-page widget-shadow scroll" id="style-2 div1">
                
                
               
         
                
                  
                  <table  class="table table-striped table-hover">
                    <tbody>
                      <tr class="active">
                        <td width="19%"><strong>IMAGEN</strong></td>
                        <td width="22%"><strong>SERVICIO</strong></td>
                        <td width="37%"><strong>DESCRIPCIÓN</strong></td>
                        <td width="22%"><strong>ACCIONES</strong></td>
                      </tr>
                      <?php if ($row_serv['id']=="") {  ?>
                      <tr><td colspan="4"><p class="text-center"> NO EXISTEN SERVICIOS REGISTRADOS</p></td></tr>
                      <?php } else {  ?>
                      <?php do { ?>
                      <tr>
                        <td><img src="../assets/images/servicios/<?php echo $row_serv['imagen']; ?>" width="150px" class="img-circle">&nbsp;</td>
                        <td><?php echo $row_serv['servicio']; ?>&nbsp;</td>
                        <td><?php echo $row_serv['descripcion']; ?>&nbsp;</td>
                        <td>
                  <a href="servicios_edit.php?id=<?php echo $row_serv['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Editar</a> 
                   <a href="servicios_del.php?id=<?php echo $row_serv['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Eliminar</a>
                            
                        </td>
                      </tr>
                      <?php } while ($row_serv = mysql_fetch_assoc($serv)); ?>
                      <?php } ?>
                    </tbody>
  </table>
                    

       
       
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
										<h4 class="modal-title" id="gridSystemModalLabel">REGISTRAR NUEVO SERVICIO</h4>
									</div>
									<div class="modal-body">
	<form method="POST" action="<?php echo $editFormAction; ?>" name="form1">
		<div class="form-group form-inline">
			<input type="text" value="" name="imagen" class="form-control" required  placeholder="Presione subir imagen">
			<input type="button" class="btn btn-primary" name="button" id="button" value="Subir imagen" onclick="javascript:subirimagen();" /> 
		</div>
		<div class="form-group">
			<input type="text" value=""  name="servicio" class="form-control"  placeholder="Servicio">
		</div>
		<div class="form-group">
			<textarea type="text" value=""  name="descripcion" class="form-control" rows="7"  placeholder="Descripción"></textarea>
		</div>
		<input type="hidden" value="" name="id" >
		<input type="submit" value="REGISTRAR" class="btn btn-block btn-success">
		<input type="hidden" name="MM_insert" value="form1">
		
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
mysql_free_result($serv);
?>
