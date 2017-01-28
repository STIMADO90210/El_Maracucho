<?php 

class conectar
{
			public static function con()
			{
				// activa la fecha zona horaria de caracas
				date_default_timezone_set('America/caracas');
				// verifica si no hay session abierta y la activa inmediatamente
				if(@!session_start())
				{	
					session_start();
				}
				
				// la conexion a la base de datos db_diario
				
				$conexion=@mysql_connect('localhost','root','');
				mysql_select_db('db_diario');
				return $conexion;
				}
				
				
}//fin de clase conectar




//============================================================================================

class noticia
{
	private $noticia;


					//metodo  constructor
					public function contruc()
					{
						$this->noticia=array();
					}
		
			//============================================================================================
				//metodo muestra todas  noticia 
			public function get_noticia()
			{
				$sql="SELECT * FROM noticia";
				$res=mysql_query($sql,conectar::con());
				while($reg=mysql_fetch_assoc($res))
				{
					$this->noticia[]=$reg;
				}
					return $this->noticia;	
			}
			
			//============================================================================================
					//metodo agregar  noticia 
			public function add_noticia($titulo,$det,$img,$fec_cad,$desc,$id_cat)
			{
				
				$sql="INSERT INTO noticia (titulo,detalle,imagen,fecha_cadena,fecha,descarga,id_categoria) VALUE('$titulo','$det','$img','$fec_cad',NOW(),'$desc','$id_cat')";
				$res=mysql_query($sql,conectar::con());
				?>
				<script type='text/javascript'> 
							alert('Noticia Guardada Exitosamente');
							window.location='noticias.php';
					  </script>;
				<?php 
			}
			
			//============================================================================================	
					//metodo editar noticia por el id las muestra en un formulario donde se hace el cambio y luego lo guarda de nuevo
		public function edit_noticia($titulo,$detalle,$img,$fec_cad,$desc,$id_cat,$id)
			{
				
				
				$sql="UPDATE noticia SET "
				."titulo='$titulo',detalle='$detalle',imagen='$img'"
				.",fecha_cadena='$fec_cad',descarga='$desc',id_categoria='$id_cat'"
				." WHERE id_not='$id' ";
				
				$res=mysql_query($sql,conectar::con());
				?>
				<script type='text/javascript'> 
							alert('Noticia Actualizada Exitosamente');
							window.location='noticias.php';
					  </script>;
				<?php 
			}
			
			
			//============================================================================================
			
			//metodo eliminar noticia por el id 			
		public function elimina_noticia($id)
			{
				
				$sql="DELETE FROM noticia  WHERE id_not='$id' ";
				$res=mysql_query($sql,conectar::con());
				?>
				<script type='text/javascript'> 
							alert('Noticia  Eliminada Exitosamente');
							window.location='noticias.php';
					  </script>;
				<?php 
			}
			
			
			//============================================================================================
	//metodo buscar noticia por el id 
	public function get_noticia_id($id)
			{
				$sql="SELECT * FROM noticia WHERE id_not='$id'";
				$res=mysql_query($sql,conectar::con());
				while($reg=mysql_fetch_assoc($res))
				{
					$this->noticia[]=$reg;
				}
					return $this->noticia;	
			}
	


	//metodo buscar noticia por el idcat 
	public function get_noticia_cat($id)
			{
				$sql="SELECT * FROM noticia WHERE id_categoria='$id'";
				$res=mysql_query($sql,conectar::con());
				while($reg=mysql_fetch_assoc($res))
				{
					$this->noticia[]=$reg;
				}
					return $this->noticia;	
			}
	

	
} //fin de clase noticia


//============================================================================================
//============================================================================================
//============================================================================================
//============================================================================================
//============================================================================================

class categoria
{
	private $categoria;


					//metodo  constructor
					public function contruc()
					{
						$this->categoria=array();
					}
		
			//============================================================================================
				//metodo muestra todas  categorias 
			public function get_categoria()
			{
				$sql="SELECT * FROM categoria";
				$res=mysql_query($sql,conectar::con());
				while($reg=mysql_fetch_assoc($res))
				{
					$this->categoria[]=$reg;
				}
					return $this->categoria;	
			}
			
			//============================================================================================
					//metodo agregar  noticia 
			public function add_categoria($categ)
			{
				
				$sql="INSERT INTO categoria (categoria) VALUE('$categ')";
				$res=mysql_query($sql,conectar::con());
				?>
				<script type='text/javascript'> 
							alert('Categoria Guardada Exitosamente');
							window.location='categorias.php';
					  </script>;
				<?php 
			}
			
			//============================================================================================	
					//metodo editar noticia por el id las muestra en un formulario donde se hace el cambio y luego lo guarda de nuevo
		public function edit_categoria($categ,$id)
			{
				
				$sql="UPDATE categoria SET categoria='$categ' WHERE id_cat='$id' ";
				$res=mysql_query($sql,conectar::con());
				?>
				<script type='text/javascript'> 
							alert('Categoria Actualizada Exitosamente');
							window.location='categorias.php';
					  </script>;
				<?php 
			}
			
			
			//============================================================================================
			
			//metodo eliminar noticia por el id 			
		public function elimina_categoria($id)
			{
				
				$sql="DELETE FROM categoria  WHERE id_cat='$id' ";
				$res=mysql_query($sql,conectar::con());
				?>
				<script type='text/javascript'> 
							alert('Categoria Eliminada Exitosamente');
							window.location='categorias.php';
					  </script>;
				<?php 
			}
			
			
			//============================================================================================
	//metodo buscar noticia por el id 
	public function get_categoria_id($id)
			{
				$sql="SELECT * FROM categoria WHERE id_cat='$id'";
				$res=mysql_query($sql,conectar::con());
				while($reg=mysql_fetch_assoc($res))
				{
					$this->categoria[]=$reg;
				}
					return $this->categoria;	
			}
			
			
	
	
} //fin de clase noticia


//============================================================================================
//============================================================================================
//============================================================================================
//============================================================================================
//============================================================================================

class comentario
{
	private $comentario;


					//metodo  constructor
					public function contruc()
					{
						$this->$comentario=array();
					}
		
			//============================================================================================
				//metodo muestra todas  categorias 
			public function get_comentario($id)
			{
				$sql="SELECT * FROM comentario where id_noticia='$id'";
				$res=mysql_query($sql,conectar::con());
				while($reg=mysql_fetch_assoc($res))
				{
					$this->comentario[]=$reg;
				}
					return $this->comentario;	
			}
			
			//============================================================================================
					//metodo agregar  noticia 
			public function add_comentario($nombre,$comenta,$id_not)
			{
				
				$sql="INSERT INTO comentario (nombre,comenta,fecha,hora,id_noticia) VALUE('$nombre','$comenta',NOW(),NOW(),'$id_not')";
				$res=mysql_query($sql,conectar::con());
				?>
				<script type='text/javascript'> 
							alert('Comentario Guardado Exitosamente');
							window.location='det_noticia.php?id=<?php echo $id_not ?>';
					  </script>;
				<?php 
			}
			
			//============================================================================================	

}  // fin de  la clase comentario


//============================================================================================
//============================================================================================
//============================================================================================
//============================================================================================
//============================================================================================

class usuario
{
	private $usuario;


					//metodo  constructor
					public function contruc()
					{
						$this->$usuario=array();
					}
		
			//============================================================================================
				//metodo muestra todas  categorias 
			public function get_usuario($id)
			{
				$sql="SELECT * FROM usuario where id_usuario='$id'";
				$res=mysql_query($sql,conectar::con());
				while($reg=mysql_fetch_assoc($res))
				{
					$this->usuario[]=$reg;
				}
					return $this->usuario;	
			}
			
			//============================================================================================
				//metodo muestra todas  categorias 
			public function get_usuario_validar($email,$password)
			{
				$sql="SELECT * FROM usuario where email='$email' and pass='$password'";
				$res=mysql_query($sql,conectar::con());
				while($reg=mysql_fetch_assoc($res))
				{
					$this->usuario[]=$reg;
				}
					return $this->usuario;	
			}
			
			//============================================================================================
					//metodo agregar  noticia 
			public function add_usuario($nombre,$comenta,$id_not)
			{
				
				$sql="INSERT INTO usuario (nombre,comenta,fecha,hora,id_noticia) VALUE('$nombre','$comenta',NOW(),NOW(),'$id_not')";
				$res=mysql_query($sql,conectar::con());
				?>
				<script type='text/javascript'> 
							alert('Usuario Guardado Exitosamente');
							window.location='index.php';
					  </script>;
				<?php 
			}
			
			//============================================================================================	

}
?>