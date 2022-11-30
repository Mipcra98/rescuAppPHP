<?php
    function detallar_rescuers($rescuer_id){
        
	$rescuer_id=limpiar_cadena($rescuer_id);
        
    
    //Verificación de rescuer
    $check_rescuer=conexion();
    $check_rescuer=$check_rescuer->query("SELECT * FROM rescuer WHERE rescuer_id='$rescuer_id'");

    if($check_rescuer->rowCount()<=0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                <a>El usuario no existe en el sistema</a>
            </div>
        ';
        exit();
    }else{
        $datos=$check_rescuer->fetch();
            echo '
                <tr>
                    <td>C.I.</td>
                    <td>'.$datos['rescuer_ci'].'</td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td>'.$datos['rescuer_name'].'</td>
                </tr>
                <tr>
                    <td>Apellido</td>
                    <td>'.$datos['rescuer_surname'].'</td>
                </tr>
                <tr>
                    <td>Número de teléfono</td>
                    <td>'.$datos['rescuer_phone'].'</td>
                </tr>
                <tr>
                    <td>Correo</td>
                    <td>'.$datos['rescuer_mail'].'</td>
                </tr>
                <tr>
                    <td>Dependencia</td>
                    <td>'.$datos['rescuer_dependency'].'</td>
                </tr>
                <tr>
                    <td>Compañía</td>
                    <td>'.$datos['rescuer_company'].'</td>
                </tr>
                <tr>
                    <td>Rol en la compañía</td>
                    <td>'.$datos['rescuer_role'].'</td>
                </tr>
            ';
            if($datos['rescuer_admin']=='1'){
                echo '
                    <tr>
                        <td>Rol de administrador</td>
                        <td>SI</td>
                    </tr>
                ';
            }else{
                echo '
                    <tr>
                        <td>Rol de administrador</td>
                        <td>NO
                        <a href="index.php?vista=rescuer_detail&rescuer_id_adm='.$datos['rescuer_id'].'" class="button is-danger is-rounded is-small">Hacer Admin</a>
                        </td>
                    </tr>
                ';
            }
            /*
            $comprobar_adm=conexion();
            $comprobar_adm=$comprobar_adm->query("SELECT rescuer_admin FROM rescuer WHERE rescuer_id='$id_session'");

            if($comprobar_adm->rowCount()>0){
                $datos_adm=$comprobar_adm->fetch();
                if($datos_adm['rescuer_admin']=='1'){
                    echo '
                    <p class="has-text-right pt-4 pb-4 pr-4">
                        <a href="index.php?vista=rescuer_detail&rescuer_id_adm='.$id.'" class="button is-danger is-rounded"><strong>Hacer Admin</strong></a>
                    </p>
                    ';
                }
            }else{
    
            }*/
        }
        $check_rescuer=null;
    }