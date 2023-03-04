<?php
  include "./php/main.php";
  date_default_timezone_set('America/Asuncion');
  $fecha_hoy=date("Y-m-d H:i:s"); 
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
    $_POST['cantidad_victimas']=$_GET['cantidad_victimas'];
    $_POST['estado_victimas']=$_GET['estado_victimas'];
    $_POST['tipo_accidente']=$_GET['tipo_accidente'];
    $_POST['tipo_choque']=$_GET['tipo_choque'];
    $_POST['tipo_arrollamiento']=$_GET['tipo_arrollamiento'];
    $_POST['coordenadas']=$_GET['coordenadas'];
    $_POST['avenida1']=$_GET['avenida1'];
    $_POST['avenida2']=$_GET['avenida2'];
    $_POST['calle1']=$_GET['calle1'];
    $_POST['calle2']=$_GET['calle2'];
    $_POST['referencia']=$_GET['referencia'];
}

$_POST['telefono']=intval($_POST['telefono']);
$_POST['genero']=intval($_POST['genero']);
$_POST['sangre']=intval($_POST['sangre']) - 1;
$_POST['numero_emergencia']=intval($_POST['numero_emergencia']);
$_POST['cantidad_victimas']=intval($_POST['cantidad_victimas']);
$_POST['estado_victimas']=intval($_POST['estado_victimas']);
$_POST['tipo_accidente']=intval($_POST['tipo_accidente']);
$_POST['tipo_choque']=intval($_POST['tipo_choque']);
$_POST['tipo_arrollamiento']=intval($_POST['tipo_arrollamiento']);


$_POST['key']=limpiar_cadena($_POST['key']);
$_POST['ci']=limpiar_cadena($_POST['ci']);
$_POST['nombre']=limpiar_cadena($_POST['nombre']);
$_POST['apellidos']=limpiar_cadena($_POST['apellidos']);
$_POST['telefono']=limpiar_cadena($_POST['telefono']);
$_POST['nacimiento']=limpiar_cadena($_POST['nacimiento']);
$_POST['correo']=limpiar_cadena($_POST['correo']);
$_POST['genero']=limpiar_cadena($_POST['genero']);
$_POST['sangre']=limpiar_cadena($_POST['sangre']);
$_POST['alergias']=limpiar_cadena($_POST['alergias']);
$_POST['medicamentos']=limpiar_cadena($_POST['medicamentos']);
$_POST['nombre_emergencia']=limpiar_cadena($_POST['nombre_emergencia']);
$_POST['numero_emergencia']=limpiar_cadena($_POST['numero_emergencia']);
$_POST['chapa_moto']=limpiar_cadena($_POST['chapa_moto']);
$_POST['chapa_auto']=limpiar_cadena($_POST['chapa_auto']);
$_POST['chapa_otro']=limpiar_cadena($_POST['chapa_otro']);
$_POST['cantidad_victimas']=limpiar_cadena($_POST['cantidad_victimas']);
$_POST['estado_victimas']=limpiar_cadena($_POST['estado_victimas']);
$_POST['tipo_accidente']=limpiar_cadena($_POST['tipo_accidente']);
$_POST['tipo_choque']=limpiar_cadena($_POST['tipo_choque']);
$_POST['tipo_arrollamiento']=limpiar_cadena($_POST['tipo_arrollamiento']);
$_POST['coordenadas']=limpiar_cadena($_POST['coordenadas']);
$_POST['avenida1']=limpiar_cadena($_POST['avenida1']);
$_POST['avenida2']=limpiar_cadena($_POST['avenida2']);
$_POST['calle1']=limpiar_cadena($_POST['calle1']);
$_POST['calle2']=limpiar_cadena($_POST['calle2']);
$_POST['referencia']=limpiar_cadena($_POST['referencia']);

/** 
  * * Otras variables que están en los reportes
  $_POST['coordenadas']
  $_POST['avenida1']
  $_POST['avenida2']
  $_POST['calle1']
  $_POST['calle2']
  $_POST['referencia']

/************************************CONFIG****************************************/

//these are just in case setting headers forcing it to always expire 
header('Cache-Control: no-cache, must-revalidate');

error_log(print_r($_POST,TRUE));

if( isset($_POST['key']) && isset($_POST['ci']) && isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['telefono']) && isset($_POST['nacimiento']) && isset($_POST['correo']) ){                                   //checks if the tag post is there and if its been a proper form post
  //set content type to CSV (to be set here to be able to access this page also with a browser)
  //header('Content-type: text/csv');

  if($_POST['key']==$SQLKEY){
    $comprobar_usuario=conexion();
    $comprobar_usuario=$comprobar_usuario->query("SELECT * FROM user WHERE user_ci='".$_POST['ci']."' AND user_mail='".$_POST['correo']."'");

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
      ":chapa_otro"=>$_POST['chapa_otro'],
    ];
    

    $guardar_usuario=conexion();
    //$guardar_huella=conexion();

    if($comprobar_usuario->rowCount()>0){
      $datos=$comprobar_usuario->fetch();
      if ($datos['user_name']!=$_POST['nombre'] || $datos['user_surname']!=$_POST['apellidos'] || $datos['user_phone']!=$_POST['telefono'] || $datos['user_blood']!=$_POST['sangre'] || $datos['user_gender']!=$_POST['genero'] || $datos['user_medsInUse']!=$_POST['medicamentos'] || $datos['user_allergies']!=$_POST['alergias'] || $datos['user_nameSurnameEmergency']!=$_POST['nombre_emergencia'] || $datos['user_phoneEmergency']!=$_POST['numero_emergencia'] || $datos['user_motorbikeSheet']!=$_POST['chapa_moto'] || $datos['user_carSheet']!=$_POST['chapa_auto'] || $datos['user_otherSheet']!=$_POST['chapa_otro']){ //  || $datos['user_birthday']!=$_POST['nacimiento']

        echo '\nEntra al update!';
        $guardar_usuario=$guardar_usuario->prepare("UPDATE user SET user_ci=:ci,user_name=:nombre,user_surname=:apellidos,
        user_phone=:telefono,user_birthday=STR_TO_DATE(:nacimiento ,'%d/%m/%Y'),user_mail=:correo,user_blood=:sangre,
        user_gender=:genero,user_medsInUse=:medicamentos,user_allergies=:alergias,
        user_nameSurnameEmergency=:nombre_emergencia,user_phoneEmergency=:numero_emergencia,
        user_motorbikeSheet=:chapa_moto,user_carSheet=:chapa_auto,user_otherSheet=:chapa_otro WHERE user_id='".$datos['user_id']."'");
        
        $guardar_huella=conexion();
        //Guardar datos para la huella de auditoría //
        
        $huella="El usuario con ID: ".$datos['user_id']." ha actualizado sus datos: ".$_POST['ci'].", ".ucwords($_POST['nombre'])." ".ucwords($_POST['apellidos']).", ".$_POST['telefono'].", ".$_POST['nacimiento'].", ".$_POST['correo'].", ".$_POST['sangre'].", ".$_POST['genero'].", ".$_POST['medicamentos'].", ".$_POST['alergias'].", ".$_POST['nombre_emergencia'].", ".$_POST['numero_emergencia'].", ".$_POST['chapa_moto'].", ".$_POST['chapa_auto'].", ".$_POST['chapa_otro'];
        
        $tipo="Usuarios";

        $marc_audit=[
          ":fecha"=>$fecha_hoy,
          ":huella"=>$huella,
          ":afecta"=>$tipo,
        ];
        $guardar_huella=$guardar_huella->prepare("INSERT INTO auditTrail(auditTrail_dateTime,auditTrail_detail,auditTrail_affectTo) VALUES 
        (:fecha,:huella,:afecta)");

        
        $guardar_huella->execute($marc_audit);
        $guardar_huella=null;

        $guardar_usuario->execute($marcadores);
      }else{
        echo '\n Se creó un reporte, pero sin actualizar el usuario!';
      }
    }else{
      echo '\n Entra al new!';
      $guardar_usuario=$guardar_usuario->prepare("INSERT INTO user(user_ci,user_name,user_surname,user_phone,user_birthday,
      user_mail,user_blood,user_gender,user_medsInUse,user_allergies,user_nameSurnameEmergency,
      user_phoneEmergency,user_motorbikeSheet,user_carSheet,user_otherSheet) VALUES (:ci,:nombre,:apellidos,:telefono,
      STR_TO_DATE(:nacimiento ,'%d/%m/%Y'),:correo,:sangre,:genero,:medicamentos,:alergias,:nombre_emergencia,
      :numero_emergencia,:chapa_moto,:chapa_auto,:chapa_otro)");

      $guardar_usuario->execute($marcadores);
      
      $comprobar_nuevo=conexion();
      $comprobar_nuevo=$comprobar_nuevo->query("SELECT user_id FROM user WHERE user_ci='".$_POST['ci']."' AND user_mail='".$_POST['correo']."'");

        $datos_nuevo=$comprobar_nuevo->fetch();
        
        //Guardar datos para la huella de auditoría
        $huella="Se creó un usuario Nuevo con ID:".$datos_nuevo['user_id']." con los siguientes datos: ".$_POST['ci'].", ".ucwords($_POST['nombre'])." ".ucwords($_POST['apellidos']).", ".$_POST['telefono'].", ".$_POST['nacimiento'].", ".$_POST['correo'].", ".$_POST['sangre'].", ".$_POST['genero'].", ".$_POST['medicamentos'].", ".$_POST['alergias'].", ".$_POST['nombre_emergencia'].", ".$_POST['numero_emergencia'].", ".$_POST['chapa_moto'].", ".$_POST['chapa_auto'].", ".$_POST['chapa_otro'];

        $tipo="Usuarios";

        $marc_audit=[
          ":fecha"=>$fecha_hoy,
          ":huella"=>$huella,
          ":afecta"=>$tipo,
        ];
        $guardar_huella=conexion();
        $guardar_huella=$guardar_huella->prepare("INSERT INTO auditTrail(auditTrail_dateTime,auditTrail_detail,auditTrail_affectTo) VALUES 
        (:fecha,:huella,:afecta)");

        $guardar_huella->execute($marc_audit);
        $guardar_huella=null;
        $comprobar_nuevo=null;
    }
  

    

  $guardar_usuario=null;
  $comprobar_usuario=null;
/*
 * * Aqui inicia el Guardado del reporte, teniendo en cuenta al usuario anteriormente insertado o actualizado
 */



  /** 
   * * Evaluación del tipo de reporte, Víctima o Testigo 
  */
  if($_POST['cantidad_victimas']>0){  
    $tipo_reporte='1';
  }else{
    $tipo_reporte='0';
  }
  
  $marcadores_reporte=[
    ":fecha"=>$fecha_hoy,
    ":cantidad_victimas"=>$_POST['cantidad_victimas'],
    ":estado_victimas"=>$_POST['estado_victimas'],
    ":tipo_accidente"=>$_POST['tipo_accidente'],
    ":tipo_choque"=>$_POST['tipo_choque'],
    ":tipo_arrollamiento"=>$_POST['tipo_arrollamiento'],
    ":coordenadas"=>$_POST['coordenadas'],
    ":avenida1"=>$_POST['avenida1'],
    ":avenida2"=>$_POST['avenida2'],
    ":calle1"=>$_POST['calle1'],
    ":calle2"=>$_POST['calle2'],
    ":referencia"=>$_POST['referencia'],
    ":tipo_reporte"=>$tipo_reporte
  ];

  $existe_usuario=conexion();
  $existe_usuario=$existe_usuario->query("SELECT user_id,user_ci,user_mail FROM user WHERE user_ci='".$_POST['ci']."' AND user_mail='".$_POST['correo']."'");

  if($existe_usuario->rowCount()>0){
    $usuario=$existe_usuario->fetch();
    $guardar_reporte=conexion();
      //Sentencia SQL en variable para poder modificar
    $report_query="INSERT INTO report (report_dateTime,report_numberVictims,report_accidentTipe,report_crashTipe,report_runOver,report_victimStatus,
    report_coordinates,report_avenue1,report_avenue2,report_street1,report_street2,report_reference,report_userId,report_userType) 
    VALUES (:fecha,:cantidad_victimas,:tipo_accidente,:tipo_choque,:tipo_arrollamiento,:estado_victimas,:coordenadas,:avenida1,:avenida2,:calle1,:calle2,:referencia,'".$usuario['user_id']."',:tipo_reporte)";
    
    $guardar_reporte=$guardar_reporte->prepare($report_query);
    $guardar_reporte->execute($marcadores_reporte);
    $guardar_reporte=null;

    $obtener_reporte=conexion();
    $obtener_reporte=$obtener_reporte->query("SELECT max(report_id) FROM report");
    if($obtener_reporte->rowCount()>0){
      $id_ultimo=$obtener_reporte->fetch();
      echo $id_ultimo[0];
      $datos_reporte=conexion();
      $datos_reporte=$datos_reporte->query("SELECT report.*,user.* FROM report INNER JOIN user ON report.report_userId=user.user_id WHERE report_id = $id_ultimo[0]");
      if($datos_reporte->rowCount()>0){
        $ultimo_reporte=$datos_reporte->fetch();
        $huella="Se creó un nuevo reporte de ID: ".$ultimo_reporte['report_id']." por parte del usuario ".ucwords($ultimo_reporte['user_name'])." ".ucwords($ultimo_reporte['user_surname'])." con user_id: ".$ultimo_reporte['user_id'].", para ver más detalles vea el reporte de id: ".$ultimo_reporte['report_id'];

      $tipo="Reportes";

      $marc_audit=[
        ":fecha"=>$fecha_hoy,
        ":huella"=>$huella,
        ":afecta"=>$tipo,
      ];

      $guar_huella=conexion();
      $guar_huella=$guar_huella->prepare("INSERT INTO auditTrail(auditTrail_dateTime,auditTrail_detail,auditTrail_affectTo) VALUES 
      (:fecha,:huella,:afecta)");

      $guar_huella->execute($marc_audit);

      
      $guar_huella=null;
      $ultimo_reporte=null;
      $obtener_reporte=null;
      }
    }

    /** 
    $ultimo_reporte=conexion();
    $ultimo_reporte=$ultimo_reporte->query("SELECT report_id FROM report WHERE report_dateTime = $fecha_hoy");
      $datos_reporte=$ultimo_reporte->fetch();
        
      //Guardar datos para la huella de auditoría de reportes
      $huella="Se creó un nuevo reporte de ID: ".$datos_reporte['report_id'];//." por parte del usuario ".ucwords($datos_reporte['user_name'])." ".ucwords($datos_reporte['user_surname'])." con user_id: ".$datos_reporte['user_id'].", para ver más detalles vea el reporte de id: ".$datos_reporte['report_id'];

      $tipo="Reportes";

      $marc_audit=[
        ":fecha"=>$fecha_hoy,
        ":huella"=>$huella,
        ":afecta"=>$tipo,
      ];

      $guar_huella=$guar_huella->prepare("INSERT INTO auditTrail(auditTrail_dateTime,auditTrail_detail,auditTrail_affectTo) VALUES 
      (:fecha,:huella,:afecta)");

      $guar_huella->execute($marc_audit);

      
      $guar_huella=null;
      $ultimo_reporte=null;
      */
  }
  $existe_usuario=null;

  } else {
     header("HTTP/1.0 400 Bad Request");
     echo "¡Usted no tiene permiso para esto!";                                       //reports if the secret key was bad
  }
} else {
        header("HTTP/1.0 400 Bad Request");
        echo "¡Los campos están vacíos!";
}


?>
