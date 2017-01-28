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

mysql_select_db($database_master, $master);
$query_citas = "SELECT * FROM citas WHERE estatus = 1 ORDER BY fechacita DESC";
$citas = mysql_query($query_citas, $master) or die(mysql_error());
$row_citas = mysql_fetch_assoc($citas);
$totalRows_citas = mysql_num_rows($citas);


/*FUNCION CONVERTIR A NUMERO A NOMBRE USUARIO*/
		function med($nro)
		{
		GLOBAL $database_master, $master;
		mysql_select_db($database_master, $master);
		$query_buscar_suario = sprintf("SELECT * FROM usuario WHERE usuario.id=%s", $nro);
		$buscar_usuario = mysql_query($query_buscar_suario, $master) or die(mysql_error());
		$row_buscar_usuario = mysql_fetch_assoc($buscar_usuario);
		$totalRows_buscar_usuario = mysql_num_rows($buscar_usuario);
		
		 echo $row_buscar_usuario['nombre']." \r \n"; 
		 echo $row_buscar_usuario['apellido'];
		}

/*FUNCION CONVERTIR A NUMERO A ESPECIALIDAD*/
		function cat($nro)
		{
		GLOBAL $database_master, $master;
		mysql_select_db($database_master, $master);
$query_especialidad = "SELECT * FROM categoria WHERE categoria.id=$nro";
$especialidad = mysql_query($query_especialidad, $master) or die(mysql_error());
$row_especialidad = mysql_fetch_assoc($especialidad);
$totalRows_especialidad = mysql_num_rows($especialidad);
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
			<div class="main-page">
				<h3 class="title1">AGENDA DE CITAS CONSEDIDAS</h3>
				<div class="blank-page widget-shadow scroll" id="style-2 div1">
                
                <div class="tables">
                  
                  <table class="table table-hover table-striped table-responsive ">
                    <tbody>
                      <tr class="active">
                        <th>FECHA DE CONSULTA&nbsp;</th>
                        <th>HORA &nbsp;</th>
                        <th>PACIENTE&nbsp;</th>
                        <th>DOCTOR&nbsp;</th>
                        <th>ESPECIALIADAD&nbsp;</th>
                        <th>ACCIONES&nbsp;</th>
                      </tr>
                      <?php do { ?>
                      <tr>
                        <td><?php setlocale(LC_TIME,'esp'); echo strftime("%A %d de %B del %Y", strtotime($row_citas['fecha'])) ?>&nbsp;</td>
                        <td><?php echo $row_citas['hora']; ?>&nbsp;</td>
                        <td><?php echo med($row_citas['id_paciente']); ?>&nbsp;</td>
                        <td><?php echo med($row_citas['id_doctor']); ?>&nbsp;</td>
                        <td><?php echo cat($row_citas['especialidad']); ?>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <?php } while ($row_citas = mysql_fetch_assoc($citas)); ?>
                    </tbody>
  </table>
                    

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
mysql_free_result($citas);
?>
