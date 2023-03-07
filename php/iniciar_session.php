<?php

    #Almacenar datos
    $correo=limpiar_cadena($_POST['login_correo']);
    $clave=limpiar_cadena($_POST['login_clave']);

    #Verificr campos obligatorios
    if($correo=="" || $clave==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                <a>No has rellenado los campos obligarorios</a>
            </div>
        ';
        exit();
     }

     #Verificar integridad de datos
    if(verificar_datos("[a-zA-Z0-9$@.-]{12,100}", $clave)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                <a>El campo de "Contaseña" no coincide con el formato solicitado</a>
            </div>
        ';
        exit();
     }

    # Verificación de E-mail
    if($correo!=""){
        if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $check_correo=conexion();
            $check_correo=$check_correo->query("SELECT rescuer_mail FROM rescuer WHERE rescuer_mail='$correo'");
            if($check_correo->rowCount()==0){
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrió un error inesperado!</strong><br>
                        <a>El "Correo electrónico" ingresado no está registrado, porfavor regístrate para acceder</a>
                    </div>
                ';
                exit();
            }
            $check_correo=null;
        }else{
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    <a>El campo "Correo electrónico" ingresado no es válido</a>
                </div>
            ';
            exit();
        }
     }


     #Validar datos ingresados con almacenados en la BD (Inicio del Login)
     $check_usuario=conexion();
     $check_usuario=$check_usuario->query("SELECT * FROM rescuer WHERE rescuer_mail='$correo'");

     if($check_usuario->rowCount()==1){
        $check_usuario=$check_usuario->fetch();
        #Inicio de Sesión
        if($check_usuario['rescuer_mail']==$correo && md5($clave)==$check_usuario['rescuer_pass']){
            if($check_usuario['rescuer_state']=='1'){
                $_SESSION['id']=$check_usuario['rescuer_id'];
                $_SESSION['ci']=$check_usuario['rescuer_ci'];
                $_SESSION['nombre']=$check_usuario['rescuer_name'];
                $_SESSION['apellido']=$check_usuario['rescuer_surname'];
                $_SESSION['correo']=$check_usuario['rescuer_mail'];
                $_SESSION['telefono']=$check_usuario['rescuer_phone'];
                $_SESSION['dependencia']=$check_usuario['rescuer_dependency'];
                $_SESSION['compania']=$check_usuario['rescuer_company'];
                $_SESSION['rol']=$check_usuario['rescuer_role'];
                $_SESSION['ademin']=$check_usuario['rescuer_admin'];

                $huella="Inicio de Sesión por el rescuer ".ucwords($_SESSION['nombre'])." ".ucwords($_SESSION['apellido'])." con rescuer_id: ".$_SESSION['id'];

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

                if(headers_sent()){
                    echo "<script> window.location.href='index.php?vista=home';</script>";
                }else{
                    header("Location: index.php?vista=home");
                }
            }else{
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Cuenta Inactiva!</strong><br>
                        <a>Por favor, póngase en contacto personalmente con un administrador para que éste active su cuenta.</a>
                    </div>
                ';
            }


        }else{ #Si no coinciden los datos de contraseña y correo con la BD
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    <a>Los datos proveidos no son correctos</a>
                </div>
            ';
        }

     }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                <a>Los datos proveidos no son correctos</a>
            </div>
        ';
     }
     $check_correo=null;