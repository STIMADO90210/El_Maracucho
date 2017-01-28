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

$colname_user = "-1";
if (isset($_GET['id'])) {
  $colname_user = $_GET['id'];
}
mysql_select_db($database_master, $master);
$query_user = sprintf("SELECT * FROM usuario WHERE id = %s", GetSQLValueString($colname_user, "int"));
$user = mysql_query($query_user, $master) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);

$colname_user_adm = "-1";
if (isset($_SESSION['MM_id'])) {
  $colname_user_adm = $_SESSION['MM_id'];
}
mysql_select_db($database_master, $master);
$query_user_adm = sprintf("SELECT * FROM usuario WHERE id = %s", GetSQLValueString($colname_user_adm, "int"));
$user_adm = mysql_query($query_user_adm, $master) or die(mysql_error());
$row_user_adm = mysql_fetch_assoc($user_adm);
$totalRows_user_adm = mysql_num_rows($user_adm);
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Admin Panel | Home ::</title>
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
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->
<!--Calender-->
<link rel="stylesheet" href="css/clndr.css" type="text/css" />
<script src="js/underscore-min.js" type="text/javascript"></script>
<script src= "js/moment-2.2.1.js" type="text/javascript"></script>
<script src="js/clndr.js" type="text/javascript"></script>
<script src="js/site.js" type="text/javascript"></script>
<!--End Calender-->
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
				<h3 class="title1">Perfil</h3>
				<div class="blank-page widget-shadow scroll" id="style-2 div1">
                    <div class=" col-lg-12">                
                    	
                        
                        <div class=" main-content">
							<div class="dropdown">
								<a href="#"  data-toggle="dropdown" aria-expanded="false">
									<p><i class="fa fa-ellipsis-v mail-icon"></i></p>
								</a>
								<ul class="dropdown-menu float-right">
                                 	<li>
										<a href="perfil_edit.php?id=<?php echo $row_user['id']; ?>&adm=<?php echo $row_user_adm['nivel'];?>" class="font-red" title="">
											<i class="fa fa-pencil"></i>
											Editar perfil
										</a>
									</li>
		
                                    
                                    
                                    
								</ul>
							</div> 
						</div>
                        
                        <img src="../assets/images/perfil/<?php echo $row_user['imagen']; ?>" class="img-circle img-thumbnail " width="150px" height="150px">
                        <hr>
                    <h3><?php echo $row_user['nombre']; ?> <?php echo $row_user['apellido']; ?> </h3>
                   
                   
                     	 <hr>

                  </div>
                    <div class="col-lg-12">
                    <table border="0" class="table">
                      <tr>
                        <td width="29%">CORREO:&nbsp;</td>
                        <td width="71%"><?php echo $row_user['email']; ?>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>CLAVE:&nbsp;</td>
                        <td><?php echo $row_user['password']; ?>&nbsp;</td>
                      </tr>
                        <tr>
                        <td>ACCESO:&nbsp;</td>
                        <td>
						  <?php if ($row_user['nivel']==1){ ?> Administrador <?php } ?>
                          <?php if ($row_user['nivel']==2){ ?> Regular <?php } ?>
                          <?php if ($row_user['nivel']==3){ ?> Doctor <?php } ?>
                            
&nbsp;</td>

                      </tr>
                    </table>
                    <a href="perfil_edit.php?id=<?php echo $row_user['id']; ?>&adm=<?php echo $row_user_adm['nivel']; ?>" class="btn btn-primary" >Editar Perfil</a>
<a href="index.php" class="btn btn-default" >Salir de Perfil</a>
                    </div>
                                       
                    
 					<div class="clearfix"></div>
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

mysql_free_result($user_adm);
?>
