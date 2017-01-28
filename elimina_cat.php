<?php 
 include_once('clases/class.php');
	
	$cat=new categoria;

	$cate=$cat->elimina_categoria($_GET['id']);

?>