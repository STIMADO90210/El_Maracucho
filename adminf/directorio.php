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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO doctor (nombre, cat, imagen) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['cat'], "text"),
                       GetSQLValueString($_POST['imagen'], "text"));

  mysql_select_db($database_master, $master);
  $Result1 = mysql_query($insertSQL, $master) or die(mysql_error());
 ?>
  <script type="text/jscript">
                window.location.href="directorio.php";
  </script>
  <?php
}


mysql_select_db($database_master, $master);
$query_cat = "SELECT * FROM categoria";
$cat = mysql_query($query_cat, $master) or die(mysql_error());
$row_cat = mysql_fetch_assoc($cat);
$totalRows_cat = mysql_num_rows($cat);


$reg_user = "0";
if (isset($_SESSION['MM_id'])) {
  $reg_user = $_SESSION['MM_id'];
}
mysql_select_db($database_master, $master);
$query_user = sprintf("SELECT * FROM usuario WHERE usuario.id=%s", $reg_user);
$user = mysql_query($query_user, $master) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);

mysql_select_db($database_master, $master);
$query_user_med = "SELECT * FROM usuario WHERE nivel = 3";
$user_med = mysql_query($query_user_med, $master) or die(mysql_error());
$row_user_med = mysql_fetch_assoc($user_med);
$totalRows_user_med = mysql_num_rows($user_med);

?>

<?php 

/*LISTA DOCTORES*/

$reg_user = "0";
if (isset($_SESSION['MM_id'])) {
  $reg_user = $_SESSION['MM_id'];
}
mysql_select_db($database_master, $master);
$query_user = sprintf("SELECT * FROM usuario WHERE usuario.id=%s", $reg_user);
$user = mysql_query($query_user, $master) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);

$nro_doctor = "0";
if (isset($_GET["regdoct"])) {
  $nro_doctor = $_GET["regdoct"];
}
mysql_select_db($database_master, $master);
$query_doctor = sprintf("SELECT * FROM doctor");
$doctor = mysql_query($query_doctor, $master) or die(mysql_error());
$row_doctor = mysql_fetch_assoc($doctor);
$totalRows_doctor = mysql_num_rows($doctor);

/*FUNCION CONVERTIR A NUMERO A NOMBRE USUARIO*/
		function med($nro)
		{
		GLOBAL $database_master, $master;
		mysql_select_db($database_master, $master);
		$query_marcafuncion = sprintf("SELECT * FROM usuario WHERE usuario.id=%s", $nro);
		$marcafuncion = mysql_query($query_marcafuncion, $master) or die(mysql_error());
		$row_marcafuncion = mysql_fetch_assoc($marcafuncion);
		$totalRows_marcafuncion = mysql_num_rows($marcafuncion);
		
		 echo $row_marcafuncion['nombre']." \r \n"; 
		 echo $row_marcafuncion['apellido'];
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
				<h3 class="title1">DIRECTORIO MEDICO</h3>
                                
                <a href="#" data-toggle="modal" data-target="#gridSystemModal" class="btn btn-lg btn-default">
                    <i class="fa fa-pencil"></i> REGISTRAR NUEVO MEDICO EN DIRECTORIO 
            </a><br><br>
            
                  <div class="modal fade" id="gridSystemModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
							<div class=" modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        	<span aria-hidden="true">&times;</span>
                                        </button>
										<h4 class="modal-title" id="gridSystemModalLabel">REGISTRAR NUEVO MEDICO EN DIRECTORIO</h4>
									</div>
									<div class="modal-body">
										<div class="row-info">
               <script>   function subirimagen()  { self.name = 'opener';
				remote = open('subirimagen/subirimg_foto.php','remote','toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=100, width=1150, height=500'); remote.focus();  }
 				</script>
                                        
	<form  class="form-group" method="post" name="form2" action="<?php echo $editFormAction; ?>">
	<div class="form-group form-inline">
		<input type="text" value="" name="imagen" class="form-control" required >
		<input type="button" class="btn btn-primary" name="button" id="button" value="Subir imagen" onclick="javascript:subirimagen();" /> 
	</div>
	<div class="form-group"> 
	<select class="form-control" name="nombre">
		<option value="0">Seleccione un Doctor</option>
		<?php do { ?>
		<option value="<?php echo $row_user_med['id']; ?>">
		      <?php echo $row_user_med['nombre']; ?> <?php echo $row_user_med['apellido']; ?>
		</option>
		<?php } while ($row_user_med = mysql_fetch_assoc($user_med)); ?>  
	</select>
	</div> 
	<div class="form-group">  
   		<select class="form-control" name="cat" >
        	<option value="0">Seleccione una Especialidad</option>
    		<?php do {  ?>
     		<option value="<?php echo $row_cat['id']?>" >
				<?php echo $row_cat['categoria']?>
          	</option>
            <?php } while ($row_cat = mysql_fetch_assoc($cat)); ?>
		</select>
	</div>
    <div class="form-group"> 
		<input type="submit" value="REGISTRAR MEDICO" class="btn btn-success btn-block">
	</div>                             
		<input type="hidden" name="MM_insert" value="form2">
	</form>
              
              
                                        </div>  
										
									</div>
									
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
</div>
                
                
	<div class="blank-page widget-shadow scroll" id="style-2 div1">
                
	<table  class="table table-hover table-striped ">
	<tr class="active">
    	<td width="23%"><strong>FOTO</strong></td>
		<td width="16%" ><strong>NOMBRE</strong></td>
        <td width="20%"><strong>ESPECIALIDAD</strong></td>
        <td width="27%"><strong>HORARIO</strong></td>
        <td width="14%"><strong>ACCIONES</strong></td>
	</tr>
	<?php if($totalRows_doctor<1) { ?>
	<tr>
		<td colspan="5" ><h4 class="text-center text-primary">NO HAY DOCTORES REGISTRADOS</h4></td>		  
	</tr>        
    <?php }else{  do { ?>
  	<tr>
      	<td><img src="../assets/images/galeria/<?php echo $row_doctor['imagen']; ?>" width="200px" /></td>
		<td >
		<?php echo med($row_doctor['nombre']) ?>
        </td>
    	<?php $n=$row_doctor['cat']; ?>
		<?php
		mysql_select_db($database_master, $master);
		$query_cat = sprintf("SELECT * FROM categoria WHERE categoria.id=%s", $n);
		$cat = mysql_query($query_cat, $master) or die(mysql_error());
		$row_cat = mysql_fetch_assoc($cat);
		$totalRows_cat = mysql_num_rows($cat);
		?>
<td ><?php echo $row_cat['categoria']; ?></td>
    <td >
		<?php mysql_select_db($database_master, $master);
		$query_hor = sprintf("SELECT * FROM horariodr WHERE horariodr.id_med=%s", $row_doctor['nombre']);
		$hor = mysql_query($query_hor, $master) or die(mysql_error());
		$row_hor = mysql_fetch_assoc($hor);
		$totalRows_hor = mysql_num_rows($hor);
		if($totalRows_hor==0){
		?>
    <a class="btn btn-primary" href="directorio_horario.php?idDr=<?php  echo $row_doctor['nombre'];  ?>">Asignar Horario</a>
    <?php }else{?>
    <a class="btn btn-default" href="directorio_edithorario.php?idDr=<?php echo $row_doctor['nombre'] ?>">Editar Horario</a>
    <?php } ?>
    </td>        
    
        <td>  <a href="directorio_del.php?idDr=<?php echo $row_doctor['nombre'] ?>" class="btn btn-danger">Eliminar</a></td>        
  </tr>
  <?php } while ($row_doctor = mysql_fetch_assoc($doctor)); }  ?>
  
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
mysql_free_result($cat);

mysql_free_result($user_med);
?>
