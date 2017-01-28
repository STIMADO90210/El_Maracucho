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
  $insertSQL = sprintf("INSERT INTO categoria (id, categoria) VALUES (%s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['categoria'], "text"));

  mysql_select_db($database_master, $master);
  $Result1 = mysql_query($insertSQL, $master) or die(mysql_error());

  $insertGoTo = "directorio_cat.php?reg=1";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_master, $master);
$query_especialidades = "SELECT * FROM categoria";
$especialidades = mysql_query($query_especialidades, $master) or die(mysql_error());
$row_especialidades = mysql_fetch_assoc($especialidades);
$totalRows_especialidades = mysql_num_rows($especialidades);
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
				<h3 class="title1">ESPECIALIDADES MEDICAS</h3>
                
                
          	<a href="#" data-toggle="modal" data-target="#gridSystemModal" class="btn btn-lg btn-default">
                    <i class="fa fa-pencil"></i> REGISTRAR ESPECIALIDAD 
            </a><br><br>
            
                  <div class="modal fade" id="gridSystemModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
							<div class=" modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        	<span aria-hidden="true">&times;</span>
                                        </button>
										<h4 class="modal-title" id="gridSystemModalLabel">REGISTRAR NUEVA ESPECIALIDAD MEDICA</h4>
									</div>
									<div class="modal-body">
										<div class="row-info">
                                          <form method="POST" name="form1" action="<?php echo $editFormAction; ?>">
                                           <div class="form-group">
                                               <input type="text" name="categoria" value="" required class="form-control" placeholder="Especialidad Medica">
                                            </div>
                                            <div class="form-group">   
                                               <input type="submit" value="REGISTRAR ESPECIALIDAD" class="btn btn-success btn-block">
                                            </div>
                                               
                                            <input type="hidden" name="id" value="">
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

                        
                        
                        
                        
                        
                
				<div class="blank-page widget-shadow scroll" id="style-2 div1">
                
                <?php if (isset($_GET['del'])==1) { ?>
                <div class="alert alert-info">
                	Especialidad Medica fue eliminada exitosamente
                		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  							<span aria-hidden="true">&times;</span>
						</button>
				</div>
                <?php } ?>
                
                                <?php if (isset($_GET['reg'])==1) { ?>
                <div class="alert alert-success">
                	Especialidad Medica fue registrada exitosamente
                		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  							<span aria-hidden="true">&times;</span>
						</button>
				</div>
                <?php } ?>
                
                 <?php if (isset($_GET['edit'])==1) { ?>
                <div class="alert alert-info">
                	Especialidad Medica fue editada exitosamente
                		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  							<span aria-hidden="true">&times;</span>
						</button>
				</div>
                <?php } ?>

                
            <table class="table table-hover">
  <tbody>
    <tr class="active">
      <td><strong>ESPECIALIDADES MEDICAS&nbsp;</strong></td>
      <td><strong>ACCIONES&nbsp;</strong></td>
    </tr>
    
    <?php if ($row_especialidades['id']=="") { ?>
    <tr>
        <td colspan="2">No hay Especialidades Medicas registradas</td>
    </tr>
    <?php } else { ?>
    
    <?php do { ?>
      <tr>
        <td><?php echo $row_especialidades['categoria']; ?>&nbsp;</td>
        <td>
          <a href="directorio_cat_edit.php?id=<?php echo $row_especialidades['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Editar</a> 
          <a href="directorio_cat_del.php?id=<?php echo $row_especialidades['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Eliminar</a>
          
          &nbsp;</td>
      </tr>
      <?php } while ($row_especialidades = mysql_fetch_assoc($especialidades)); ?>
      
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
mysql_free_result($especialidades);
?>
