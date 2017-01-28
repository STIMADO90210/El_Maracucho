<?php 
// verifica si no hay session abierta y la activa inmediatamente
				
				if(!session_start())
				{	
					session_start();
				}



?>