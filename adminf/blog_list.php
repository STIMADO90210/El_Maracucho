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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_consulta_blog = 10;
$pageNum_consulta_blog = 0;
if (isset($_GET['pageNum_consulta_blog'])) {
  $pageNum_consulta_blog = $_GET['pageNum_consulta_blog'];
}
$startRow_consulta_blog = $pageNum_consulta_blog * $maxRows_consulta_blog;

mysql_select_db($database_master, $master);
$query_consulta_blog = "SELECT * FROM blog ORDER BY id DESC";
$query_limit_consulta_blog = sprintf("%s LIMIT %d, %d", $query_consulta_blog, $startRow_consulta_blog, $maxRows_consulta_blog);
$consulta_blog = mysql_query($query_limit_consulta_blog, $master) or die(mysql_error());
$row_consulta_blog = mysql_fetch_assoc($consulta_blog);

if (isset($_GET['totalRows_consulta_blog'])) {
  $totalRows_consulta_blog = $_GET['totalRows_consulta_blog'];
} else {
  $all_consulta_blog = mysql_query($query_consulta_blog);
  $totalRows_consulta_blog = mysql_num_rows($all_consulta_blog);
}
$totalPages_consulta_blog = ceil($totalRows_consulta_blog/$maxRows_consulta_blog)-1;

$colname_user = "-1";
if (isset($_SESSION['MM_id'])) {
  $colname_user = $_SESSION['MM_id'];
}
mysql_select_db($database_master, $master);
$query_user = sprintf("SELECT * FROM usuario WHERE id = %s", GetSQLValueString($colname_user, "int"));
$user = mysql_query($query_user, $master) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);

$queryString_consulta_blog = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_consulta_blog") == false && 
        stristr($param, "totalRows_consulta_blog") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_consulta_blog = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_consulta_blog = sprintf("&totalRows_consulta_blog=%d%s", $totalRows_consulta_blog, $queryString_consulta_blog);




$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO blog (id, imagen, titulo, articulo, fecha, autor) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['imagen'], "text"),
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['articulo'], "text"),
					   GetSQLValueString($_POST['fecha'], "date"),
					    GetSQLValueString($_POST['autor'], "text"));

  mysql_select_db($database_master, $master);
  $Result1 = mysql_query($insertSQL, $master) or die(mysql_error());

  $insertGoTo = "blog_list.php?add=1";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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

<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js"></script>

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
				<h3 class="title1">NOTICIAS PUBLICADAS</h3>
                <a type="button" class="btn btn-lg btn-default" data-toggle="modal" data-target=".bs-example-modal-lg"> <i class="fa fa-pencil"></i> Publicar Nuevo Blog</a>
                
                <br><br>
                
               


<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
  						
									
    <div class="modal-content">
    <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        	<span aria-hidden="true">&times;</span>
                                        </button>
										<h4 class="modal-title" id="gridSystemModalLabel">NUEVO BLOG</h4>
									</div>
                                    
                                    <div class="modal-body">
    
                       <form method="post" name="form1" action="">
                  
                  
                            <script>  
								  function subirimagen()
								  {
									  self.name = 'opener';
									  remote = open('subirimagen/subirimg_blog.php','remote','toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=100, width=1150, height=500');
									  remote.focus();
								  }
 						 </script>
                  
                 
                    <div class=" form-group form-inline">
                        <input type="button" class="btn btn-primary" name="button" id="button" value="Subir imagen" onclick="javascript:subirimagen();"/> 
                        <input type="text" name="imagen" value="" class="form-control" required >
                    </div>
                    <div class=" form-group">
                    <input type="text" name="titulo" value="" size="32" class="form-control" required placeholder="Titulo">
                    </div>
                    <div class=" form-group">
                    <textarea type="text" id="articulo" name="articulo" value=""  class="form-control" rows="10" required >Articulo </textarea>
                    <script>
					            CKEDITOR.replace( 'articulo' );
					        </script>
                    </div>
                    <div class=" form-group">
                    <input type="submit" value="Publicar Blog" class="btn btn-success">
                    </div>
                    
                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="fecha" value="">
                    <input type="hidden" name="autor" value="<?php echo $row_user['nombre']; ?> <?php echo $row_user['apellido']; ?>">
                    <input type="hidden" name="MM_insert" value="form1">
                  </form>
                  
                  </div>

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
										<h4 class="modal-title" id="gridSystemModalLabel">NUEVO BLOG</h4>
									</div>
									<div class="modal-body">


                                    
	<div class="row-info">
                                        </div>  
										
									</div>
									
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
</div>

                
				<div class="blank-page widget-shadow scroll" id="style-2 div1">
                
                
                <?php if ((isset($_GET['add'])) && ($_GET['add'] == 1)) {?>
                <div class="alert alert-success">
                	El blog se ha registrado y publicado exitosamente
                		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  							<span aria-hidden="true">&times;</span>
						</button>
				</div>
                <?php }?> 
                <?php if ((isset($_GET['del'])) && ($_GET['del'] == 1)) {?>
                <div class="alert alert-info">
                	El blog se ha eliminado exitosamente
                		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  							<span aria-hidden="true">&times;</span>
						</button>
				</div>
                <?php }?> 
                <?php if ((isset($_GET['edit'])) && ($_GET['edit'] == 1)) {?>
                <div class="alert alert-primary">
                	Se han gurdado los cambios exitosamente
                		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  							<span aria-hidden="true">&times;</span>
						</button>
				</div>
                <?php }?> 
                
                <?php if ($row_consulta_blog['id']=="") { ?>
                <div class="alert alert-info">No existen blog Registrados</div>
                <?php } else { ?>
            
                <?php do { ?>
                <div class="container">
                  <div class="row">
                    <ul class="thumbnails">
                      <div class="col-lg-8">
                        <div class="thumbnail">
                            <img src="../assets/images/blog/<?php echo $row_consulta_blog['imagen']; ?>" alt="" class="img-responsive" />
                            <div class="caption">
                              <h3><?php echo $row_consulta_blog['titulo']; ?></h3><hr>
                              <small class="text-muted"><i class="fa fa-user"></i> <?php echo $row_consulta_blog['autor']; ?>  <i class="fa fa-calendar"></i>  <?php setlocale(LC_ALL,'es_ES'); echo $fecha = strftime("%d de %B de %Y", strtotime($row_consulta_blog['fecha'])) ; ?> </small>
                              <p><?php echo substr($row_consulta_blog['articulo'], 0, 300); ?></p><br>
                              <a href="blog_edit.php?id=<?php echo $row_consulta_blog['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Editar</a> 
                              <a href="blog_del.php?id=<?php echo $row_consulta_blog['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Eliminar</a>
                              </p>
                            </div>
                        </div>
                      </div>
                    </ul>
                  </div>
  </div>
                  <?php } while ($row_consulta_blog = mysql_fetch_assoc($consulta_blog)); ?>

                <?php } ?>
             
              <div class="text-center">
              
       <?php if ($pageNum_consulta_blog > 0) { // Show if not first page ?>
 		<a href="<?php printf("%s?pageNum_consulta_blog=%d%s", $currentPage, 0, $queryString_consulta_blog); ?>" class="btn btn-default">			
         	<i class="fa fa-fast-backward"></i> Primero
        </a>
     	<?php } // Show if not first page ?>
		<?php if ($pageNum_consulta_blog > 0) { // Show if not first page ?>
    	<a href="<?php printf("%s?pageNum_consulta_blog=%d%s", $currentPage, max(0, $pageNum_consulta_blog - 1), $queryString_consulta_blog); ?>" class="btn btn-default"><i class="fa fa-backward"></i> Anterior </a>
                      <?php } // Show if not first page ?>
                      <?php if ($pageNum_consulta_blog < $totalPages_consulta_blog) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_consulta_blog=%d%s", $currentPage, min($totalPages_consulta_blog, $pageNum_consulta_blog + 1), $queryString_consulta_blog); ?>" class="btn btn-default">Siguiente <i class="fa fa-forward"></i></a>
                      <?php } // Show if not last page ?>
                      <?php if ($pageNum_consulta_blog < $totalPages_consulta_blog) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_consulta_blog=%d%s", $currentPage, $totalPages_consulta_blog, $queryString_consulta_blog); ?>" class="btn btn-default">&Uacute;ltimo <i class="fa fa-fast-forward"></i></a>
                      <?php } // Show if not last page ?>
                      
                      <br>
                       <small>Blog <?php echo ($startRow_consulta_blog + 1) ?> a <?php echo min($startRow_consulta_blog + $maxRows_consulta_blog, $totalRows_consulta_blog) ?> de <?php echo $totalRows_consulta_blog ?> Registrados</small>
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
mysql_free_result($consulta_blog);


?>
