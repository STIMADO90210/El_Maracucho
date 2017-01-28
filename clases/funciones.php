	<?php 

function dia($d)
{
							if ($d==1){$dia="Lunes";}
							if ($d==2){$dia="Martes";}
							if ($d==3){$dia="Miercoles";}
							if ($d==4){$dia="Jueves";}
							if ($d==5){$dia="Viernes";}
							if ($d==6){$dia="Sabado";}
							if ($d==7){$dia="Domingo";}
							
		
	return $dia;
	
	}



function mes($d)
{
	
							if ($d==1){$mes="Enero"; return $mes;}
							if ($d==2){$mes="Febrero";return $mes;}
							if ($d==3){$mes="Marzo";return $mes;}
							if ($d==4){$mes="Abril";return $mes;}
							if ($d==5){$mes="Mayo";return $mes;}
							if ($d==6){$mes="Junio";return $mes;}
							if ($d==7){$mes="Julio"; return $mes;}
							if ($d==8){$mes="Agosto";return $mes;}
							if ($d==9){$mes="Septiembre";return $mes;}
							if ($d==10){$mes="Obtubre";return $mes;}
							if ($d=11){$mes="Noviembre";return $mes;}
							if ($d==12){$mes="Diciembre";return $mes;}
							
		
	
	
	}



?>