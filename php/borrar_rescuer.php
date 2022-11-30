<?php
    $rescuer_id_del=limpiar_cadena($_GET['rescuer_id_del']);
    if($_SESSION['ademin']=='1'){ //comprobación de admin
        //verificación de existencia del rescuer
        $check_existencia=conexion();
        $check_existencia=$check_existencia->query("SELECT rescuer_id FROM rescuer WHERE rescuer_id='$rescuer_id_del'");
        if($check_existencia->rowCount()==1){
            
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
                        <div class="notification is-success is-light">
                            <strong>¡Usuario Eliminado!</strong><br>
                            <a>El rescuer se pudo eliminar exitosamente</a>
                        </div>
                    ';
                }else{
                    echo '
                        <div class="notification is-danger is-light">
                            <strong>¡Ocurrió un error inesperado!</strong><br>
                            <a>No se ha podido eliminar el rescuer, intente en unos instantes</a>
                        </div>
                    ';
                }


                $eliminar_rescuer=null;
            }else{
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrió un error inesperado!</strong><br>
                        <a>No es posible eliminar a este rescuer, está asociado con uno o más reportes</a>
                    </div>
                ';
            }
            $check_reporte=null;
        }else{
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    <a>El usuario que intenta eliminar no existe</a>
                </div>
            ';

        }
        $check_existencia=null;
    }