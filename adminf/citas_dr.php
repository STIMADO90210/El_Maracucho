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

$colname_citas_all = "-1";
if (isset($_SESSION['MM_id'])) {
  $colname_citas_all = $_SESSION['MM_id'];
}
mysql_select_db($database_master, $master);
$query_citas_all = sprintf("SELECT * FROM citas WHERE id_doctor = %s ORDER BY id DESC", GetSQLValueString($colname_citas_all, "int"));
$citas_all = mysql_query($query_citas_all, $master) or die(mysql_error());
$row_citas_all = mysql_fetch_assoc($citas_all);
$totalRows_citas_all = mysql_num_rows($citas_all);

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

	
	 	echo $row_especialidad['categoria'];
	
		}
		
		/*FUNCION BUSCAR DIA*/
		
	function dia($dianro)
	{
		GLOBAL $database_master, $master;
mysql_select_db($database_master, $master);
$query_dianro = sprintf("SELECT * FROM semana WHERE semana.id=%s", $dianro);
$dianro = mysql_query($query_dianro, $master) or die(mysql_error());
$row_dianro = mysql_fetch_assoc($dianro);
$totalRows_dianro = mysql_num_rows($dianro);
		
	 	echo $row_dianro['dia'];
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
				<h3 class="title1">CITAS</h3>
				<div class="blank-page widget-shadow scroll" id="style-2 div1">
                
                <h3>SOLICITUD DE CITAS</h3><br>
                
            
                  <table class="table table-hover table-striped table-responsive table-bordered">
                    <tbody>
                      <tr class="active">
                        <td width="12%"><strong>FECHA </strong></td>
                        <td width="18%"><strong>PACIENTE</strong>&nbsp;</td>
                        <td width="18%"><strong>MEDICO</strong>&nbsp;</td>
                        <td width="15%"><strong>ESPECIALIDAD</strong>&nbsp;</td>
                        <td width="10%"><strong>DIA</strong>&nbsp;</td>
                        <td width="14%"><strong>ACCIONES</strong>&nbsp;</td>
                        
                      </tr>
                      <?php if ($row_citas_all['id']=="") { ?>
                      <tr><td colspan="6"><p class="text-center">NO EXISTEN CITAS GENERADAS</p></td></tr>
                      <?php } else { ?>
                      
                          <?php do { ?>
                      <tr>
                        <td><?php setlocale(LC_TIME,'esp'); echo strftime("%d %B %Y", strtotime($row_citas_all['fecha'])) ?></td>
                        <td><?php echo med($row_citas_all['id_paciente']); ?></td>
                        <td><?php echo med($row_citas_all['id_doctor']); ?></td>
                        <td><?php echo cat($row_citas_all['especialidad']); ?></td>
                        <td><?php echo dia($row_citas_all['dia']); ?></td>
                        <td><?php if ($row_citas_all['estatus']=="0"){ ?>
                        		<a href="citas_adm.php?idDr=<?php echo $row_citas_all['id_doctor']; ?>&id=<?php echo $row_citas_all['id']; ?>" class="btn btn-primary btn-sm">CONCEDER CITA</a>
                          <?php } ?>
                    <?php if ($row_citas_all['estatus']=="1"){ ?><a href="citas_admitem.php?id=<?php echo $row_citas_all['id']; ?>" class="btn btn-default btn-sm">CITA CONSEDIDA</a> 
                          <?php } ?>
                      </td>
                      
                    	  <?php } while ($row_citas_all = mysql_fetch_assoc($citas_all)); ?>
                      </tr>
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
mysql_free_result($citas_all);
?>
