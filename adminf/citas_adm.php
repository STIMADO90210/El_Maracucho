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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "actualizar_cita")) {
  $updateSQL = sprintf("UPDATE citas SET dia=%s, fechacita=%s, hora=%s, estatus=%s, comentario_dr=%s WHERE id=%s",
                       GetSQLValueString($_POST['dia'], "int"),
                       GetSQLValueString($_POST['fechacita'], "text"),
                       GetSQLValueString($_POST['hora'], "text"),
                       GetSQLValueString($_POST['estatus'], "int"),
                       GetSQLValueString($_POST['comentario_dr'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_master, $master);
  $Result1 = mysql_query($updateSQL, $master) or die(mysql_error());

  $updateGoTo = "citas_admitem.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_citas_all = "-1";
if (isset($_GET['id'])) {
  $colname_citas_all = $_GET['id'];
}
mysql_select_db($database_master, $master);
$query_citas_all = sprintf("SELECT * FROM citas WHERE id = %s", GetSQLValueString($colname_citas_all, "int"));
$citas_all = mysql_query($query_citas_all, $master) or die(mysql_error());
$row_citas_all = mysql_fetch_assoc($citas_all);
$totalRows_citas_all = mysql_num_rows($citas_all);


$colname_horario = "-1";
if (isset($_GET['idDr'])) {
  $colname_horario = $_GET['idDr'];
}
mysql_select_db($database_master, $master);
$query_horario = sprintf("SELECT * FROM horariodr WHERE id_med = %s", GetSQLValueString($colname_horario, "int"));
$horario = mysql_query($query_horario, $master) or die(mysql_error());
$row_horario = mysql_fetch_assoc($horario);
$totalRows_horario = mysql_num_rows($horario);

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
				<h3 class="title1">DETALLES DE CITA</h3>
				<div class="blank-page widget-shadow scroll" id="style-2 div1">
                
                <h3>SOLICITUD DE CITA</h3><br>
                
            
              <table class="table table-hover table-responsive table-striped">
  <tbody>
  	<tr>
      <td width="30%"><strong>FECHA DE SOLICITUD</strong></td>
      <td width="70%"><?php setlocale(LC_TIME,'esp'); echo strftime("%A %d de %B del %Y", strtotime($row_citas_all['fecha'])) ?></td>
    </tr>
    <tr>
      <td><strong>PACIENTE</strong></td>
      <td><?php echo med($row_citas_all['id_paciente']); ?></td>
    </tr>
    <tr>
      <td><strong>DOCTOR</strong></td>
      <td><?php echo med($row_citas_all['id_doctor']); ?></td>
    </tr>
    <tr>
      <td><strong>ESPECIALIDAD</strong></td>
      <td><?php echo cat($row_citas_all['especialidad']); ?></td>
    </tr>
    <tr>
      <td><strong>DIA</strong></td>
      <td><?php echo dia($row_citas_all['dia']); ?></td>
    </tr>
     <tr>
      <td height="100px"><strong>COMENTARIO</strong></td>
      <td><?php echo $row_citas_all['comentario']; ?></td>
    </tr>
  </tbody>
</table>

      
       <h3>CONCEDIENDO CITA</h3><hr>
       <form method="POST" name="actualizar_cita" action="<?php echo $editFormAction; ?>">
       
       <div class="form-group form-inline">
       DIA: 
       <select name="dia" class="form-control">
  <?php if ($row_horario['lunes']=="1") { ?> <option value="1" <?php if ($row_citas_all['dia']==1) {echo "SELECTED";} ?>>Lunes</option> <?php } ?>
  <?php if ($row_horario['martes']=="1") { ?> <option value="2" <?php if ($row_citas_all['dia']==2) {echo "SELECTED";} ?>>Marte</option> <?php } ?>
  <?php if ($row_horario['miercoles']=="1") { ?> <option value="3" <?php if ($row_citas_all['dia']==3) {echo "SELECTED";} ?>>Miercoles</option> <?php } ?>
  <?php if ($row_horario['jueves']=="1") { ?> <option value="4" <?php if ($row_citas_all['dia']==4) {echo "SELECTED";} ?>>Jueves</option> <?php } ?>
  <?php if ($row_horario['viernes']=="1") { ?> <option value="5" <?php if ($row_citas_all['dia']==5) {echo "SELECTED";} ?>>Viernes</option> <?php } ?>
  <?php if ($row_horario['sabado']=="1") { ?> <option value="6" <?php if ($row_citas_all['dia']==6) {echo "SELECTED";} ?>>Sabado</option> <?php } ?>
  <?php if ($row_horario['domingo']=="1") { ?> <option value="7" <?php if ($row_citas_all['dia']==7) {echo "SELECTED";} ?>>Domingo</option> <?php } ?>
       
       </select>
       FECHA: 
       <input type="date" name="fechacita" value="" class="form-control" required>
       HORA: 
       <input type="time" name="hora" value="" required class="form-control" >
       </div>
       <div class="form-group">
       <textarea class="form-control" rows="5" name="comentario_dr" placeholder="comentario"></textarea>
       </div>
       <div class="form-group">
       
		<input type="hidden" value="<?php echo $row_citas_all['id']; ?>" name="id">
        <input type="hidden" value="1" name="estatus">
       
       <input type="submit" class="btn btn-block btn-success btn-lg" value="CONCEDER CITA">
       </div>
       <input type="hidden" name="MM_update" value="actualizar_cita">
       
       </form>         


                
                
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

mysql_free_result($horario);
?>
