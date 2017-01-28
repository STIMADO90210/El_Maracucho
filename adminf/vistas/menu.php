<?php require_once('../clases/conectar.php'); ?>
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

$colname_user_menu = "-1";
if (isset($_SESSION['MM_id'])) {
  $colname_user_menu = $_SESSION['MM_id'];
}

?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
?>
<div class=" sidebar" role="navigation">
            <div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
					<ul class="nav" id="side-menu">
                    
                    <?php if (6==6) { ?>
                    
						<li>
							<a href="http://localhost/zonacomercial.com.ve/"><i class="fa fa-home nav_icon"></i>Dashboard</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-user nav_icon"></i> Usuario  <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="">Administar Usuarios</a>
								</li>
								
							</ul>
							<!-- /nav-second-level -->
						</li>
                        <li>
							<a href="#"><i class="fa fa-user-md nav_icon"></i>Categorias <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
                                                                 <li>
									<a href=""> Rayos X</a>
								</li>
								
								
                                
                          	</ul>
							<!-- /nav-second-level -->
						</li>
                         <li>
							<a href="#"><i class="fa fa-circle  nav_icon"></i> Cuentas  <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href=""> Servicios</a>
								</li>
								
                               
                          	</ul>
							<!-- /nav-second-level -->
						</li>
                       <?php } ?>
                       
                       
                        
                       
                       
						
					</ul>
					<!-- //sidebar-collapse -->
				</nav>
			</div>
		</div>

