<?php
    $rescuer_id_del=limpiar_cadena($_GET['rescuer_id_del']);

    //verificar que el usuario de sesión en Admin
	$check_adm=conexion();
	$check_adm=$check_adm->query("SELECT rescuer_admin FROM rescuer WHERE rescuer_id='".$_SESSION['id']."'");
	$check_adm=$check_adm->fetch();

    if($_SESSION['ademin']=='1' && $check_adm['rescuer_admin'=='1']){ //comprobación de admin
        //verificación de existencia del rescuer
        $check_existencia=conexion();
        $check_existencia=$check_existencia->query("SELECT rescuer_id,rescuer_name,rescuer_surname FROM rescuer WHERE rescuer_id='$rescuer_id_del'");
        if($check_existencia->rowCount()==1){
            $datos_borrar=$check_existencia->fetch();

            //verificación de existencia de un reporte asociado a un rescuer
            $check_reporte=conexion();
            $check_reporte=$check_reporte->query("SELECT report_rescuerId FROM report WHERE report_rescuerId='$rescuer_id_del' LIMIT 1");
            if($check_reporte->rowCount()<=0){
                
                //Eliminación del Rescuer
                $eliminar_rescuer=conexion();
                $eliminar_rescuer=$eliminar_rescuer->prepare("DELETE FROM rescuer WHERE rescuer_id=:id");
                $eliminar_rescuer->execute([":id"=>$rescuer_id_del]);
                if($eliminar_rescuer->rowCount()==1){
                    echo '
                        <div class="notification has-background-success column has-text-black-bis box">
                            <strong>¡Usuario Eliminado!</strong><br>
                            <a>El rescuer se pudo eliminar exitosamente</a>
                        </div>
                    ';
                    $huella="Se eliminó el rescuer ".ucwords($datos_borrar['rescuer_name'])." ".ucwords($datos_borrar['rescuer_surname'])." de ID: ".$rescuer_id_del." por parte del administrador ".ucwords($_SESSION['nombre'])." ".ucwords($_SESSION['apellido'])." con rescuer_id: ".$_SESSION['id'];

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
                    $datos_borrar=null;
                }else{
                    echo '
                        <div class="notification has-background-danger column has-text-black-bis box">
                            <strong>¡Ocurrió un error inesperado!</strong><br>
                            <a>No se ha podido eliminar el rescuer, intente en unos instantes</a>
                        </div>
                    ';
                }


                $eliminar_rescuer=null;
            }else{
                echo '
                    <div class="notification has-background-danger column has-text-black-bis box">
                        <strong>¡Ocurrió un error inesperado!</strong><br>
                        <a>No es posible eliminar a este rescuer, está asociado con uno o más reportes</a>
                    </div>
                ';
            }
            $check_reporte=null;
        }else{
            echo '
                <div class="notification has-background-danger column has-text-black-bis box">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    <a>El usuario que intenta eliminar no existe</a>
                </div>
            ';

        }
        $check_existencia=null;
    }else{
        echo '
            <div class="notification has-background-danger column has-text-black-bis box">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                <a>Usted no puede realizar esta operación</a>
            </div>
        ';
    }
    $check_adm=null;