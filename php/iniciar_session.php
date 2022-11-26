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
     if(verificar_datos("[a-zA-Z0-9$@.-]{12,100}",$clave)){
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