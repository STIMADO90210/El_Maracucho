<?php   //include_once('clases/sessiones.php'); ?>
<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<section class="mbr-navbar mbr-navbar--freeze mbr-navbar--absolute mbr-navbar--sticky mbr-navbar--auto-collapse" id="ext_menu-4">
    <div class="mbr-navbar__section mbr-section">
        <div class="mbr-section__container container">
            <div class="mbr-navbar__container">
                <div class="mbr-navbar__column mbr-navbar__column--s mbr-navbar__brand">
                    <span class="mbr-navbar__brand-link mbr-brand mbr-brand--inline">
                        <span class="mbr-brand__logo"><a href=""><img class="mbr-navbar__brand-img mbr-brand__img" src="assets/images/depositphotos_12800835-Vector-newspaper-icon.png" alt="El Maracucho"></a></span>
                        <span class="mbr-brand__name"><a class="mbr-brand__name text-white" href="index.php">EL MARACUCHO</a></span>
                    </span>
                </div>
                <div class="mbr-navbar__hamburger mbr-hamburger text-white"><span class="mbr-hamburger__line"></span></div>
                <div class="mbr-navbar__column mbr-navbar__menu">
                    <nav class="mbr-navbar__menu-box mbr-navbar__menu-box--inline-right">
    <div class="mbr-navbar__column">
    
    <ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-decorator mbr-buttons--active">
 <li class="mbr-navbar__item">
 <a class="mbr-buttons__link btn text-white" href="index.php">INICIO</a></li>
 <li class="mbr-navbar__item">
 <a class="mbr-buttons__link btn text-white" href="noticias.php">NOTICIAS</a></li>
 <li class="mbr-navbar__item">
 <a class="mbr-buttons__link btn text-white" href="categorias.php">CATEGORIAS</a></li>
 <?php if(isset($_SESSION['nombre'])){?>
 <li class="mbr-navbar__item">
 <a class="dropdown-toggle mbr-buttons__link btn text-white text-uppercase" data-toggle="dropdown" role="button" href="index.php"><?php echo  $_SESSION['nombre']; ?></a>
 <ul class="dropdown-menu color-rojo " role="menu">
           <?php if($_SESSION['nivel']==1){ ?>
               <li class="mbr-buttons__link btn text-white"><a href="clases/admin.php?op=0">ADMINISTRAR</a></li>
			   
               <?php }else{?>
               <li class="mbr-buttons__link btn text-white"><a href="clases/cuenta.php">MI CUENTA</a></li>
               <?php }?>
               <li class="mbr-buttons__link btn  text-white"><a href="logout.php">SALIR DEL SISTEMA</a></li>
              
          </ul>
 </li>
 <?php }?>
 

 
 </ul>
 
 
  
 </div>
                        
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
   
    
</section>
