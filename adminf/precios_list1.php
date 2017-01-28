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
$query_precios = "SELECT * FROM precios";
$precios = mysql_query($query_precios, $master) or die(mysql_error());
$row_precios = mysql_fetch_assoc($precios);
$totalRows_precios = mysql_num_rows($precios);
?>
<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../assets/images/logo-1181x1181-5-128x128-58.png" type="image/x-icon">
    <title>Panel Administración</title>
    <!--Iconos-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet" type="text/css">
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
  </head>
<!-- NAVBAR
================================================== -->
  <body>
<!--Menu de Navegación-->
<?php include("menu.php"); ?>


  
<div class="modal fade" id="precios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">CONFIRMACIÓN</h4>
      </div>
      <div class="modal-body">
       ¿Esta seguro que desea vaciar todo el contenido de la tabla precios?<br>
       Si es asi precione borar, sino precione cancelar.
      </div>
      <div class="modal-footer">
        <a class="btn btn-danger" href="precios_del.php" >BORRAR</a>
        <button type="button" class="btn btn-primary" data-dismiss="modal">CANCELAR</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="precios2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">IMPORTAR PRECIOS</h4>
      </div>
      <div class="modal-body">
       <?php include('importar.php'); ?>
      </div>
      <div class="modal-footer"><small><b>NOTA:</b> recuerde que el archivo que contiene los precios deben estar en excel en formato CSV</small></div>
      
    </div>
  </div>
</div>

    
  <!--MENU DE NAVEGACION-->

<div class="container">

<h1>Precios Medisur</h1>

<a  class="btn btn-danger" data-toggle="modal" data-target="#precios" >BORRAR PRECIOS</a>
<a  class="btn btn-primary" data-toggle="modal" data-target="#precios2" >AGREGAR PRECIO</a>
<hr>
<p>Para actualiar precios dede borrar precios primero, luego agregar los nuevos precios.</p>
<?php if ($totalRows_precios=="") {} else { ?>
<p>Precios actualizados: <?php echo date("d M Y", strtotime($row_precios['fecha'])); ?> </p>
<?php } ?>
<table class="table table-hover table-striped">
  <tbody>
    <tr class="active"> 
      <td><strong>ID&nbsp;</strong></td>
      <td><strong>NOMBRE UNIDAD&nbsp;</strong></td>
      <td><strong>CODIGO DE SERVICIO&nbsp;</strong></td>
      <td><strong>NOMBRE&nbsp;</strong></td>
      <td><strong>PRECIO&nbsp;</strong></td>
    </tr>
    <?php if ($totalRows_precios=="") { ?>
    <tr><td colspan="5" align="center"> NO HAY PRECIOS REGISTRADO</td></tr>
    <?php } else { ?>
    
    
    <?php do { ?>
      <tr>
        <td><?php echo $row_precios['id']; ?>&nbsp;</td>
        <td><?php echo $row_precios['nomuni']; ?>&nbsp;</td>
        <td><?php echo $row_precios['cod_serv']; ?>&nbsp;</td>
        <td><?php echo $row_precios['nombre']; ?>&nbsp;</td>
        <td><?php echo $row_precios['precio3']; ?>&nbsp;</td>
      </tr>
      <?php } while ($row_precios = mysql_fetch_assoc($precios)); ?>
      <?php } ?>
  </tbody>
</table>


<div class="container" style="height:150px"></div>


   





    

    </div><!-- /.container -->
    
    
      <!-- FOOTER -->
<?php include("footer.php"); ?>


    <!-- Bootstrap core JavaScript-->
<script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>

  </body>
</html>
<?php
mysql_free_result($precios);
?>
