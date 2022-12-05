<?php require "./inc/session_start.php";?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php
      include "./inc/head.php";
    ?>
  </head>
  <body>
    <?php
        if(!isset($_GET['vista']) || $_GET['vista']==""){
          if(isset($_SESSION['id'])){
            $_GET['vista']="home";
          }else{
            $_GET['vista']="login";
          }
        }

        if(is_file("./vistas/".$_GET['vista'].".php") && $_GET['vista']!="register" && $_GET['vista']!="login" && $_GET['vista']!="404"){

        #Cierre de sesión forzada
        if((!isset($_SESSION['id']) || $_SESSION['id']=="") || (!isset($_SESSION['correo']) || $_SESSION['correo']=="")){
              
          include "./vistas/logout.php";
          exit();
        }


          include "./inc/navbar.php";

          include "./vistas/".$_GET['vista'].".php";
          
          include "./inc/script.php";

        }else{
          if($_GET['vista']=="login"){
            include "./vistas/login.php";
          }
          if($_GET['vista']=="register"){
            include "./vistas/rescuer_new.php";
          }else{
            include "./vistas/404.php";
          }
        }
    ?>
  </body>
</html>