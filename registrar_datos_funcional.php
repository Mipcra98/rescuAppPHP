<?php
  include "./php/main.php";

//SETTINGS//
//This code is something you set in the APP so random people cant use it.
$SQLKEY="RescuAppLlaveWillian";

if( isset($_GET['nombre'])) {
    $_POST['key']=$_GET['key'];
    $_POST['ci']=$_GET['ci'];
    $_POST['nombre']=$_GET['nombre'];
    $_POST['apellidos']=$_GET['apellidos'];
    $_POST['telefono']=$_GET['telefono'];
    $_POST['nacimiento']=$_GET['nacimiento'];
    $_POST['correo']=$_GET['correo'];
    $_POST['genero']=$_GET['genero'];
    $_POST['sangre']=$_GET['sangre'];
    $_POST['alergias']=$_GET['alergias'];
    $_POST['medicamentos']=$_GET['medicamentos'];
    $_POST['nombre_emergencia']=$_GET['nombre_emergencia'];
    $_POST['numero_emergencia']=$_GET['numero_emergencia'];
    $_POST['chapa_moto']=$_GET['chapa_moto'];
    $_POST['chapa_auto']=$_GET['chapa_auto'];
    $_POST['chapa_otro']=$_GET['chapa_otro'];
}

$_POST['telefono']=intval($_POST['telefono']);
$_POST['genero']=intval($_POST['genero']);
$_POST['sangre']=intval($_POST['sangre']) - 1;
$_POST['numero_emergencia']=intval($_POST['numero_emergencia']);

/************************************CONFIG****************************************/

//these are just in case setting headers forcing it to always expire 
header('Cache-Control: no-cache, must-revalidate');

error_log(print_r($_POST,TRUE));

if( isset($_POST['key']) && isset($_POST['ci']) && isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['telefono']) && isset($_POST['nacimiento']) && isset($_POST['correo']) ){                                   //checks if the tag post is there and if its been a proper form post
  //set content type to CSV (to be set here to be able to access this page also with a browser)
  //header('Content-type: text/csv');

  if($_POST['key']==$SQLKEY){
    $comprobar_usuario=conexion();
    $comprobar_usuario=$comprobar_usuario->query("SELECT user_id,user_ci,user_mail FROM user WHERE user_ci='".$_POST['ci']."' AND user_mail='".$_POST['correo']."'");

    $marcadores=[
      ":ci"=>$_POST['ci'],
      ":nombre"=>$_POST['nombre'],
      ":apellidos"=>$_POST['apellidos'],
      ":telefono"=>$_POST['telefono'],
      ":nacimiento"=>$_POST['nacimiento'],
      ":correo"=>$_POST['correo'],
      ":sangre"=>$_POST['sangre'],
      ":genero"=>$_POST['genero'],
      ":medicamentos"=>$_POST['medicamentos'],
      ":alergias"=>$_POST['alergias'],
      ":nombre_emergencia"=>$_POST['nombre_emergencia'],
      ":numero_emergencia"=>$_POST['numero_emergencia'],
      ":chapa_moto"=>$_POST['chapa_moto'],
      ":chapa_auto"=>$_POST['chapa_auto'],
      ":chapa_otro"=>$_POST['chapa_otro']
    ];
    
    $guardar_usuario=conexion();
    
    /*$guardar_usuario=$guardar_usuario->prepare("INSERT INTO user(user_ci,user_name,user_surname,user_phone,user_birthday,
      user_mail,user_blood,user_gender,user_medsInUse,user_allergies,user_nameSurnameEmergency,
      user_phoneEmergency,user_motorbikeSheet,user_carSheet,user_otherSheet) VALUES (:ci,:nombre,:apellidos,:telefono,
      STR_TO_DATE(:nacimiento ,'%d/%m/%Y'),:correo,:sangre,:genero,:medicamentos,:alergias,:nombre_emergencia,
      :numero_emergencia,:chapa_moto,:chapa_auto,:chapa_otro)");*/

    if($comprobar_usuario->rowCount()>'0'){
      $datos=$comprobar_usuario->fetch();
      echo 'Entra al update!\n';
      $guardar_usuario=$guardar_usuario->prepare("UPDATE user SET user_ci=:ci,user_name=:nombre,user_surname=:apellidos,
      user_phone=:telefono,user_birthday=STR_TO_DATE(:nacimiento ,'%d/%m/%Y'),user_mail=:correo,user_blood=:sangre,
      user_gender=:genero,user_medsInUse=:medicamentos,user_allergies=:alergias,
      user_nameSurnameEmergency=:nombre_emergencia,user_phoneEmergency=:numero_emergencia,
      user_motorbikeSheet=:chapa_moto,user_carSheet=:chapa_auto,user_otherSheet=:chapa_otro WHERE user_id='".$datos['user_id']."'");
    }else{
      echo 'Entra al new!\n';
      $guardar_usuario=$guardar_usuario->prepare("INSERT INTO user(user_ci,user_name,user_surname,user_phone,user_birthday,
      user_mail,user_blood,user_gender,user_medsInUse,user_allergies,user_nameSurnameEmergency,
      user_phoneEmergency,user_motorbikeSheet,user_carSheet,user_otherSheet) VALUES (:ci,:nombre,:apellidos,:telefono,
      STR_TO_DATE(:nacimiento ,'%d/%m/%Y'),:correo,:sangre,:genero,:medicamentos,:alergias,:nombre_emergencia,
      :numero_emergencia,:chapa_moto,:chapa_auto,:chapa_otro)");
    }
  
  $guardar_usuario->execute($marcadores);

  if($guardar_usuario->rowCount()==1){
     echo '
         <div class="notification is-success is-light">
             <strong>¡Usuario Registrado!</strong><br>
             <a>El usuario se registró exitosamente</a>
         </div>
     ';
  }else{
     echo '
         <div class="notification is-danger is-light">
             <strong>¡Ocurrió un error inesperado!</strong><br>
             <a>No se ha podido registrar este usuario, porfavor intente nuevamente</a>
         </div>
     ';
     echo $guardar_usuario->errorInfo();
  }

  $guardar_usuario=null;

  } else {
     header("HTTP/1.0 400 Bad Request");
     echo "¡Usted no tiene permiso para esto!";                                       //reports if the secret key was bad
  }
} else {
        header("HTTP/1.0 400 Bad Request");
        echo "¡Los campos están vacíos!";
}


?>
