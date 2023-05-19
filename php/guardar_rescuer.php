<?php
    require_once "../php/main.php";

     #Almacenar datos
     $ci=limpiar_cadena($_POST['rescuer_ci']);
     $nombre=limpiar_cadena($_POST['rescuer_nombre']);
     $apellido=limpiar_cadena($_POST['rescuer_apellido']);
     $mail=limpiar_cadena($_POST['rescuer_correo']);
     $tel=limpiar_cadena($_POST['rescuer_telefono']);
     $dependency=limpiar_cadena($_POST['rescuer_dependencia']);
     $company=limpiar_cadena($_POST['rescuer_compania']);
     $role=limpiar_cadena($_POST['rescuer_rol']);

     $clave_1=limpiar_cadena($_POST['usuario_clave_1']);
     $clave_2=limpiar_cadena($_POST['usuario_clave_2']);

     $ci=intval($ci);
     $tel=intval($tel);

     #Verificr campos obligatorios
     if($ci=="" || $nombre=="" || $apellido=="" || $mail=="" || $tel=="" || $dependency=="" || $company=="" || $role=="" || $clave_1=="" || $clave_2==""){
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

     #Verificar integridad de datos
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

     if(verificar_datos("[a-zA-Z0-9$@.-]{12,100}",$clave_1) || verificar_datos("[a-zA-Z0-9$@.-]{12,100}",$clave_2)){
        echo '
            <div class="notification has-background-danger column has-text-black-bis box">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                <p>Los campos de "Contaseña" no coinciden con el formato solicitado</p>
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

     if($mail!=""){
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
            $check_mail=conexion();
            $check_mail=$check_mail->query("SELECT rescuer_mail FROM rescuer WHERE rescuer_mail='$mail'");
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


     #Verificación de claves iguales
     if($clave_1!=$clave_2){
        echo '
            <div class="notification has-background-danger column has-text-black-bis box">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                <p>Los campos de "Contraseña y Repetición" no coinciden entre sí</p>
            </div>
        ';
        exit();
     }else{
        $clave=md5($clave_1);
        #$clave=password_hash($clave_1,PASSWORD_BCRYPT,['cost'=>10]);
     }

     #Guardar datos a la BD
     $guardar_rescuer=conexion();
     $guardar_rescuer=$guardar_rescuer->prepare("INSERT INTO rescuer(rescuer_ci,rescuer_pass,rescuer_name,rescuer_surname,
     rescuer_mail,rescuer_dependency,rescuer_company,rescuer_role,rescuer_phone,rescuer_admin,rescuer_state) VALUES(:ci,
     :clave_encriptada,:nombre,:apellido,:mail,:dependency,:company,:role,:phone,:adm,:sta)");

    $marcadores=[
        ":ci"=>$ci,
        ":clave_encriptada"=>$clave,
        ":nombre"=>$nombre,
        ":apellido"=>$apellido,
        ":mail"=>$mail,
        ":dependency"=>$dependency,
        ":company"=>$company,
        ":role"=>$role,
        ":phone"=>$tel,
        ":adm"=>0,
        ":sta"=>0
    ];

     $guardar_rescuer->execute($marcadores);

     if($guardar_rescuer->rowCount()==1){
        echo '
            <div class="notification has-background-success column has-text-black-bis box">
                <strong>¡Usuario Registrado!</strong><br>
                <p>El usuario se registró exitosamente</p>
            </div>
        ';
        $id_rescuer=conexion();
        $id_rescuer=$id_rescuer->query("SELECT max(rescuer_id) FROM rescuer");
        if($id_rescuer->rowCount()>0){
            $id_rescuer=$id_rescuer->fetch();
            $huella="Se creó un el rescuer con ID:".$id_rescuer[0]." con los siguientes datos: ".$ci.", ".ucwords($nombre)." ".ucwords($apellido).", ".$mail.", ".$tel.", ".$dependency.", ".$company.", ".$role;

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
        }
        $id_rescuer=null;
     }else{
        echo '
            <div class="notification has-background-danger column has-text-black-bis box">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                <p>No se ha podido registrar este usuario, porfavor intente nuevamente</p>
            </div>
        ';
     }
     $guardar_rescuer=null;