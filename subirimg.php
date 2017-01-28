<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- Site made with Mobirise Website Builder v2.6.1, index.php -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v2.6.1, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../assets/images/small logo-300x300.png" type="image/x-icon">
  <link href="../assets/bootstrap/css/stilacho.css" rel="stylesheet" type="text/css" />
  <meta name="description" content="CALLCENTER">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:700,400&amp;subset=cyrillic,latin,greek,vietnamese">
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/bootstrap/css/stilacho.css">
  <link rel="stylesheet" href="../assets/mobirise/css/style.css">
  <link rel="stylesheet" href="../assets/mobirise-slider/style.css">
  <link rel="stylesheet" href="../assets/mobirise-gallery/style.css">
  <link rel="stylesheet" href="../assets/mobirise/css/mbr-additional.css" type="text/css">
  

</head>
 
<body>
<div class="fondos">
  <?php if ((isset($_POST["enviado"])) && ($_POST["enviado"]== "form1"))
{
$archifoto	= $_FILES['imagen']['name'];
move_uploaded_file($_FILES['imagen']['tmp_name'],"../assets/images/".$archifoto);?>


  <script>

opener.document.form1.imagen.value="<?php echo  $archifoto  ?>";
self.close();

</script>


  <?php

}else{

?>
  <form action="subirimg.php" method="post" enctype="multipart/form-data" name="form1" id="form1" >
    <p><input name="imagen" class="btn btn-success btn-md " type="file" size="50" /></p>
    <p><input name="botton" type="submit" class="btn btn-success btn-md " id="botton" value="Subir Imagen"  /></p>
    <input name="enviado" type="hidden" value="form1" />
    
    
  </form>
  <?php }?>
</div>
</body>
</html>