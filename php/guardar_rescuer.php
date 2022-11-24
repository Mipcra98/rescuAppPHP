<?php
    require_once "main.php";

     #Almacenar datos
     $ci=limpiar_cadena($_POST['rescuer_ci']);
     $nombre=limpiar_cadena($_POST['rescuer_name']);
     $apellido=limpiar_cadena($_POST['rescuer_surname']);
     $mail=limpiar_cadena($_POST['rescuer_mail']);
     $tel=limpiar_cadena($_POST['rescuer_phone']);
     $dependency=limpiar_cadena($_POST['rescuer_dependency']);
     $company=limpiar_cadena($_POST['rescuer_company']);
     $role=limpiar_cadena($_POST['rescuer_role']);

     $clave_1=limpiar_cadena($_POST['usuario_clave_1']);
     $clave_2=limpiar_cadena($_POST['usuario_clave_2']);

     #Verificando campos obligatorios
     if($ci=="" || $nombre=="" || $apellido=="" || $mail=="" || $tel=="" || $dependency=="" || $company=="" || $role=="" || $clave_1=="" || $clave_2==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>Ocurrió un error inesperado</strong>
                <a>No has rellenado los campos obligarorios</a>
            </div>
        ';
        exit();
     }