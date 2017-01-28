<?php 
 include_once('clases/class.php');

	$noti=new noticia;
	$noticia=$noti->elimina_noticia($_GET['id']);

?>