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
  $updateSQL = sprintf("UPDATE blog SET imagen=%s, titulo=%s, articulo=%s WHERE id=%s",
                       GetSQLValueString($_POST['imagen'], "text"),
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['articulo'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_master, $master);
  $Result1 = mysql_query($updateSQL, $master) or die(mysql_error());

  $updateGoTo = "blog_list.php?edit=1";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_consulta_blog = "-1";
if (isset($_GET['id'])) {
  $colname_consulta_blog = $_GET['id'];
}
mysql_select_db($database_master, $master);
$query_consulta_blog = sprintf("SELECT * FROM blog WHERE id = %s", GetSQLValueString($colname_consulta_blog, "int"));
$consulta_blog = mysql_query($query_consulta_blog, $master) or die(mysql_error());
$row_consulta_blog = mysql_fetch_assoc($consulta_blog);
$totalRows_consulta_blog = mysql_num_rows($consulta_blog);
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
				<h3 class="title1">EDITAR BLOG</h3>
				<div class="blank-page widget-shadow scroll" id="style-2 div1">
                
         <div class="container">
                  <div class="row">
                    <ul class="thumbnails">
                      <div class="col-lg-8">
                        <div class="thumbnail">
                         
                             
						
						
                       
                          <img src="../assets/images/blog/<?php echo $row_consulta_blog['imagen']; ?>" alt="" class="img-responsive" />
                          
                        
                        
                       
                            <script>  
								  function subirimagen()
								  {
									  self.name = 'opener';
									  remote = open('subirimagen/subirimg_blog.php','remote','toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=100, width=1150, height=500');
									  remote.focus();
								  }
 						 </script>
                         
                          
                        
                          
                            <div class="caption">
                              
                              <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
                              
                              
                            
                              
                              
                              
                             
  	<div class=" form-group form-inline">
    <input type="button" class="btn btn-primary" name="button" id="button" value="Cambiar imagen" onclick="javascript:subirimagen();"/>
     <input type="text" readonly name="imagen" value="<?php echo htmlentities($row_consulta_blog['imagen'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control" required>
    </div>
    <div class=" form-group">
     <input type="text" name="titulo" value="<?php echo htmlentities($row_consulta_blog['titulo'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control" required>
    </div>
    <div class=" form-group">
     <textarea name="articulo" id="articulo" cols="50" rows="20" class="form-control" required><?php echo htmlentities($row_consulta_blog['articulo'], ENT_COMPAT, 'utf-8'); ?></textarea>
     <script>
					            CKEDITOR.replace( 'articulo' );
					        </script>
    </div>
    <div class=" form-group">
     <input type="submit" value="Actualizar registro" class="btn btn-primary">
    </div>
     <input type="hidden" name="id" value="<?php echo $row_consulta_blog['id']; ?>">
     <input type="hidden" name="MM_update" value="form1">
     <input type="hidden" name="id" value="<?php echo $row_consulta_blog['id']; ?>">
   </form>
   <p>&nbsp;</p>
   <br><br><br>
                              
                            </div>
                        </div>
                      </div>
                    </ul>
                  </div>
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
