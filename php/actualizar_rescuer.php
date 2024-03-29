<?php
    require_once "../inc/session_start.php";

    require_once "main.php";
    
    $id=limpiar_cadena($_POST['rescuer_id']);
    
    //Verificación de rescuer
    $check_rescuer=conexion();
    $check_rescuer=$check_rescuer->query("SELECT * FROM rescuer WHERE rescuer_id='$id'");

    if($check_rescuer->rowCount()<=0){
        echo '
            <div class="notification has-background-danger column has-text-black-bis box">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                <p>El usuario no existe en el sistema</p>
            </div>
        ';
        exit();
    }else{
        $datos=$check_rescuer->fetch();
    }
    $check_rescuer=null;

     #Almacenar datos en una variable
     $clave_act=limpiar_cadena($_POST['usuario_clave']);
     $correo_act=limpiar_cadena($_POST['rescuer_correo']);

     #Verificar campos obligatorios para comprobar el perfil
     if($clave_act=="" || $correo_act==""){
        echo '
            <div class="notification has-background-danger column has-text-black-bis box">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                <p>No has rellenado los campos obligarorios, que corresponde a su "Correo" y "Contraseña" vigentes</p>
            </div>
        ';
        exit();
     }

     if(verificar_datos("[a-zA-Z0-9$@.-]{12,100}",$clave_act)){
        echo '
            <div class="notification has-background-danger column has-text-black-bis box">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                <p>El campo de "Contaseña" no coinciden con el formato solicitado</p>
            </div>
        ';
        exit();
     }


    //Validación del correo
    if(filter_var($correo_act, FILTER_VALIDATE_EMAIL)){
    }else{
        echo '
            <div class="notification has-background-danger column has-text-black-bis box">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                <p>El campo "Correo electrónico" ingresado no es válido</p>
            </div>
        ';
        exit();
    }
    
    //Verificación de campos con los datos en la BD
    $check_datos=conexion();
    $check_datos=$check_datos->query("SELECT rescuer_mail,rescuer_pass FROM rescuer WHERE rescuer_mail='$correo_act' AND rescuer_id='".$_SESSION['id']."'");

    if($check_datos->rowCount()==1){
        $check_datos=$check_datos->fetch();

        if($check_datos['rescuer_mail']!=$correo_act || md5($clave_act)!=$check_datos['rescuer_pass']){
            echo '
                <div class="notification has-background-danger column has-text-black-bis box">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    <p>Los campos de "Correo" y "Contraseña" actuales no son correctos</p>
                </div>
            ';
            exit();
        }

    }else{
        echo '
            <div class="notification has-background-danger column has-text-black-bis box">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                <p>Los campos de "Correo" y "Contraseña" actuales no son correctos</p>
            </div>
        ';
        exit();
    }
    $check_datos=null;
    
    
    $ci=limpiar_cadena($_POST['rescuer_ci']);
    $nombre=limpiar_cadena($_POST['rescuer_nombre']);
    $apellido=limpiar_cadena($_POST['rescuer_apellido']);
    $new_mail=limpiar_cadena($_POST['rescuer_nuevo_correo']);
    $tel=limpiar_cadena($_POST['rescuer_telefono']);
    $dependency=limpiar_cadena($_POST['rescuer_dependencia']);
    $company=limpiar_cadena($_POST['rescuer_compania']);
    $role=limpiar_cadena($_POST['rescuer_rol']);
    $new_clave_1=limpiar_cadena($_POST['usuario_clave_nueva_1']);
    $new_clave_2=limpiar_cadena($_POST['usuario_clave_nueva_2']);

    $ci=intval($ci);
    $tel=intval($tel);
    
    #Verificr campos obligatorios
    if($ci=="" || $nombre=="" || $apellido=="" || $new_mail=="" || $tel=="" || $dependency=="" || $company=="" || $role==""){
        echo '
            <div class="notification has-background-danger column has-text-black-bis box">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                <p>No has rellenado los campos obligarorios</p>
            </div>
        ';
        exit();
     }  

     #Verificar integridad de datos
     if(verificar_datos("[0-9 ]{3,40}",$ci)){
        echo '
            <div class="notification has-background-danger column has-text-black-bis box">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                <p>El campo "C.I." no coincide con el formato solicitado</p>
            </div>
        ';
        exit();
    }else{
        $check_ci=conexion();
        $check_ci=$check_ci->query("SELECT rescuer_ci FROM rescuer WHERE rescuer_ci='$ci'");
        if($check_ci->rowCount()>0){
            echo '
                <div class="notification has-background-danger column has-text-black-bis box">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    <p>El "C.I." ya está en uso, por favor elija otro</p>
                </div>
            ';
            exit();
        }
        $check_mail=null;
     }  

     if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ ]{3,40}",$nombre)){
        echo '
            <div class="notification has-background-danger column has-text-black-bis box">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                <p>El campo "Nombre" no coincide con el formato solicitado</p>
            </div>
        ';
        exit();
     }

     if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ ]{3,40}",$apellido)){
        echo '
            <div class="notification has-background-danger column has-text-black-bis box">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                <p>El campo "Apellidos" no coincide con el formato solicitado</p>
            </div>
        ';
        exit();
     }

     if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ ]{3,70}",$dependency)){
        echo '
            <div class="notification has-background-danger column has-text-black-bis box">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                <p>El campo "Dependencia" no coincide con el formato solicitado</p>
            </div>
        ';
        exit();
     }

     if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ ]{3,70}",$company)){
        echo '
            <div class="notification has-background-danger column has-text-black-bis box">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                <p>El campo "Compañía" no coincide con el formato solicitado</p>
            </div>
        ';
        exit();
     }

     if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ ]{3,70}",$role)){
        echo '
            <div class="notification has-background-danger column has-text-black-bis box">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                <p>El campo "Rol en la dependencia" no coincide con el formato solicitado</p>
            </div>
        ';
        exit();
     }

     if(verificar_datos("[0-9$@.-]{8,15}",$tel)){
        echo '
            <div class="notification has-background-danger column has-text-black-bis box">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                <p>El campo "Teléfono" no coincide con el formato solicitado</p>
            </div>
        ';
        exit();
     }



    # Verificación de E-mail en uso

     if($new_mail!="" && $new_mail!=$datos['rescuer_mail']){
        if(filter_var($new_mail, FILTER_VALIDATE_EMAIL)){
            $check_mail=conexion();
            $check_mail=$check_mail->query("SELECT rescuer_mail FROM rescuer WHERE rescuer_mail='$new_mail'");
            if($check_mail->rowCount()>0){
                echo '
                    <div class="notification has-background-danger column has-text-black-bis box">
                        <strong>¡Ocurrió un error inesperado!</strong><br>
                        <p>El "Correo electrónico" ya está en uso, por favor elija otro</p>
                    </div>
                ';
                exit();
            }
            $check_mail=null;
        }else{
            echo '
                <div class="notification has-background-danger column has-text-black-bis box">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    <p>El campo "Correo electrónico" ingresado no es válido</p>
                </div>
            ';
            exit();
        }
     }

    if($new_clave_1!="" || $new_clave_2=""){
        //Verificación de contraseñas de acuerdo al pattern
        if(verificar_datos("[a-zA-Z0-9$@.-]{12,100}",$new_clave_1) || verificar_datos("[a-zA-Z0-9$@.-]{12,100}",$new_clave_2)){
            echo '
                <div class="notification has-background-danger column has-text-black-bis box">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    <p>Los campos de "Contraseña y Repetición" no coinciden con el formato solicitado</p>
                </div>
            ';
            exit();
        }else{
            #Verificación de claves iguales
            if($new_clave_1!=$new_clave_2){
                echo '
                    <div class="notification has-background-danger column has-text-black-bis box">
                        <strong>¡Ocurrió un error inesperado!</strong><br>
                        <p>Los campos de "Contraseña y Repetición" no coinciden entre sí</p>
                    </div>
                ';
                exit();
            }else{
                $clave=md5($new_clave_1);
                #$clave=password_hash($clave_1,PASSWORD_BCRYPT,['cost'=>10]);
            }
        }
    }else{
        $clave=$datos['rescuer_pass'];
    }

    #ACTUALIZAR datos a la BD
    $actualizar_rescuer=conexion();
    $actualizar_rescuer=$actualizar_rescuer->prepare("UPDATE rescuer SET rescuer_ci=:ci,rescuer_pass=:clave_encriptada,
    rescuer_name=:nombre,rescuer_surname=:apellido,rescuer_mail=:new_mail,rescuer_dependency=:dependency,
    rescuer_company=:company,rescuer_role=:role,rescuer_phone=:phone WHERE rescuer_id=:id");

   $marcadores=[
       ":id"=>$id,
       ":ci"=>$ci,
       ":clave_encriptada"=>$clave,
       ":nombre"=>$nombre,
       ":apellido"=>$apellido,
       ":new_mail"=>$new_mail,
       ":dependency"=>$dependency,
       ":company"=>$company,
       ":role"=>$role,
       ":phone"=>$tel
   ];

    if($actualizar_rescuer->execute($marcadores)){
       echo '
           <div class="notification  has-background-success column has-text-black-bis box">
               <strong>¡Usuario Actualizado!</strong><br>
               <p>El usuario se actualizó exitosamente</p>
           </div>
       ';
       $_SESSION['ci']=$ci;
       $_SESSION['nombre']=$nombre;
       $_SESSION['apellido']=$apellido;
       $_SESSION['correo']=$new_mail;
       $_SESSION['telefono']=$tel;
       $_SESSION['dependencia']=$dependency;
       $_SESSION['compania']=$company;
       $_SESSION['rol']=$role;

       $huella="Se actualizó el rescuer con ID:".$_SESSION['id']." con los siguientes datos: ".$_SESSION['ci'].", ".ucwords($_SESSION['nombre'])." ".ucwords($_SESSION['apellido']).", ".$_SESSION['correo'].", ".$_SESSION['telefono'].", ".$_SESSION['dependencia'].", ".$_SESSION['compania'].", ".$_SESSION['rol'];

        $tipo="Rescuers";

        $marc_audit=[
          ":fecha"=>fecha_ahora(),
          ":huella"=>$huella,
          ":afecta"=>$tipo,
        ];
        $guardar_huella=conexion();
        $guardar_huella=$guardar_huella->prepare("INSERT INTO auditTrail(auditTrail_dateTime,auditTrail_detail,auditTrail_affectTo) VALUES 
        (:fecha,:huella,:afecta)");

        $guardar_huella->execute($marc_audit);
        $guardar_huella=null;
    }else{
       echo '
           <div class="notification has-background-danger column has-text-black-bis box">
               <strong>¡Ocurrió un error inesperado!</strong><br>
               <p>No se ha podido registrar este usuario, porfavor intente nuevamente</p>
           </div>
       ';
    }
    $actualizar_rescuer=null;