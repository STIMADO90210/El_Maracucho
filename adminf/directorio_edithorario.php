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
  $updateSQL = sprintf("UPDATE horariodr SET id_med=%s, lun1=%s, lun2=%s, mar1=%s, mar2=%s, mie1=%s, mie2=%s, jue1=%s, jue2=%s, vie1=%s, vie2=%s, sab1=%s, sab2=%s, dom1=%s, dom2=%s, lunes=%s, martes=%s, miercoles=%s, jueves=%s, viernes=%s, sabado=%s, domingo=%s WHERE id=%s",
                       GetSQLValueString($_POST['id_med'], "int"),
                       GetSQLValueString($_POST['lun1'], "text"),
                       GetSQLValueString($_POST['lun2'], "text"),
                       GetSQLValueString($_POST['mar1'], "text"),
                       GetSQLValueString($_POST['mar2'], "text"),
                       GetSQLValueString($_POST['mie1'], "text"),
                       GetSQLValueString($_POST['mie2'], "text"),
                       GetSQLValueString($_POST['jue1'], "text"),
                       GetSQLValueString($_POST['jue2'], "text"),
                       GetSQLValueString($_POST['vie1'], "text"),
                       GetSQLValueString($_POST['vie2'], "text"),
                       GetSQLValueString($_POST['sab1'], "text"),
                       GetSQLValueString($_POST['sab2'], "text"),
                       GetSQLValueString($_POST['dom1'], "text"),
                       GetSQLValueString($_POST['dom2'], "text"),
                       GetSQLValueString(isset($_POST['lunes']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['martes']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['miercoles']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['jueves']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['viernes']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['sabado']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['domingo']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_master, $master);
  $Result1 = mysql_query($updateSQL, $master) or die(mysql_error());

  $updateGoTo = "directorio.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_edit_horario = "-1";
if (isset($_GET['idDr'])) {
  $colname_edit_horario = $_GET['idDr'];
}
mysql_select_db($database_master, $master);
$query_edit_horario = sprintf("SELECT * FROM horariodr WHERE id_med = %s", GetSQLValueString($colname_edit_horario, "int"));
$edit_horario = mysql_query($query_edit_horario, $master) or die(mysql_error());
$row_edit_horario = mysql_fetch_assoc($edit_horario);
$totalRows_edit_horario = mysql_num_rows($edit_horario);

$colname_user_horarioedit = "-1";
if (isset($_GET['idDr'])) {
  $colname_user_horarioedit = $_GET['idDr'];
}
mysql_select_db($database_master, $master);
$query_user_horarioedit = sprintf("SELECT * FROM doctor WHERE nombre = %s", GetSQLValueString($colname_user_horarioedit, "int"));
$user_horarioedit = mysql_query($query_user_horarioedit, $master) or die(mysql_error());
$row_user_horarioedit = mysql_fetch_assoc($user_horarioedit);
$totalRows_user_horarioedit = mysql_num_rows($user_horarioedit);

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
				<h3 class="title1">HORARIO</h3>
				<div class="blank-page widget-shadow scroll" id="style-2 div1">
                <table class="table">
  <tbody>
    <tr class="active">
      <td width="27%"><img src="../assets/images/galeria/<?php echo $row_user_horarioedit['imagen']; ?>" width="200px" /></td>
      <td width="73%" align="center" valign="middle"><H3>&nbsp;</H3>
        <H3>&nbsp;</H3>
        <H3><?php echo med($row_user_horarioedit['nombre']); ?></H3>
      <p>
     
	  <?php echo cat($row_user_horarioedit['cat']); ?>
      </p>
      </td>
    </tr>
  </tbody>
</table>

                
                
                
          
	<form action="<?php echo $editFormAction; ?>" method="POST" name="form1" class="form-group form-inline" role="form">
<table class="table table-hover table-striped">
<tr class="active">
	<td><strong>DIAS</strong></td>
	<td><strong>HORA DE ENTRADA</strong></td>
	<td><strong>HORA DE SALIDA</strong></td>
</tr>
<tr>
	<td><input type="checkbox" value="" name="lunes" <?php if (!(strcmp(htmlentities($row_edit_horario['lunes'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} ?> > LUNES</td>
	<td> <input type="time" class="form-control" value="<?php echo $row_edit_horario['lun1']; ?>" name="lun1"></td>
	<td> <input type="time" class="form-control" value="<?php echo $row_edit_horario['lun2']; ?>" name="lun2"></td>
</tr>
<tr>
	<td><input type="checkbox" value="" name="martes" <?php if (!(strcmp(htmlentities($row_edit_horario['martes'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} ?> > MARTES</td>
	<td> <input type="time" class="form-control" value="<?php echo $row_edit_horario['mar1']; ?>" name="mar1"></td>
	<td> <input type="time" class="form-control" value="<?php echo $row_edit_horario['mar2']; ?>" name="mar2"></td>
</tr>
<tr>
	<td><input type="checkbox" value="" name="miercoles" <?php if (!(strcmp(htmlentities($row_edit_horario['miercoles'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} ?>> MIERCOLES</td>
	<td> <input type="time" class="form-control" value="<?php echo $row_edit_horario['mie1']; ?>" name="mie1"></td>
	<td> <input type="time" class="form-control" value="<?php echo $row_edit_horario['mie2']; ?>" name="mie2"></td>
</tr>
<tr>
	<td><input type="checkbox" value="" name="jueves" <?php if (!(strcmp(htmlentities($row_edit_horario['jueves'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} ?> > JUEVES</td>
	<td> <input type="time" class="form-control" value="<?php echo $row_edit_horario['jue1']; ?>" name="jue1"></td>
	<td> <input type="time" class="form-control" value="<?php echo $row_edit_horario['jue2']; ?>" name="jue2"></td>
</tr>
<tr>
	<td><input type="checkbox" value="" name="viernes" <?php if (!(strcmp(htmlentities($row_edit_horario['viernes'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} ?> > VIERNES</td>
	<td> <input type="time" class="form-control" value="<?php echo $row_edit_horario['vie1']; ?>" name="vie1"></td>
	<td> <input type="time" class="form-control" value="<?php echo $row_edit_horario['vie2']; ?>" name="vie2"></td>
</tr>
<tr>
	<td><input type="checkbox" value="" name="sabado" <?php if (!(strcmp(htmlentities($row_edit_horario['sabado'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} ?> > SABADO</td>
	<td> <input type="time" class="form-control" value="<?php echo $row_edit_horario['sab1']; ?>" name="sab1"></td>
	<td> <input type="time" class="form-control" value="<?php echo $row_edit_horario['sab2']; ?>" name="sab2"></td>
</tr>
<tr>
	<td><input type="checkbox" value="" name="domingo" <?php if (!(strcmp(htmlentities($row_edit_horario['domingo'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} ?> > DOMINGO</td>
	<td> <input type="time" class="form-control" value="<?php echo $row_edit_horario['dom1']; ?>" name="dom1"></td>
	<td> <input type="time" class="form-control" value="<?php echo $row_edit_horario['dom2']; ?>" name="dom2"></td>
</tr>

</table>
          
           <input type="submit" value="ACTUALIZAR HORARIO" class="btn btn-primary btn-block" />
          <input type="hidden" name="id_med" value="<?php echo $row_edit_horario['id_med']; ?>" />
          <input type="hidden" name="id" value="<?php echo $row_edit_horario['id']; ?>" />
          <input type="hidden" name="MM_update" value="form1">
          
        
          
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
