<?php
    function detallar_rescuers($rescuer_id){
        
        $rescuer_id=limpiar_cadena($rescuer_id);
        
        //verificar que el usuario de sesión en Admin
        $check_adm=conexion();
        $check_adm=$check_adm->query("SELECT rescuer_admin FROM rescuer WHERE rescuer_id='".$_SESSION['id']."'");
        $check_adm=$check_adm->fetch();
        
        //Verificación de rescuer
        $check_rescuer=conexion();
        $check_rescuer=$check_rescuer->query("SELECT * FROM rescuer WHERE rescuer_id='$rescuer_id'");

        if($check_rescuer->rowCount()<=0){
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    <a>El Rescuer no existe en el sistema</a>
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
                if($_SESSION['ademin']=='1' && $check_adm['rescuer_admin']=='1'){
                    if($datos['rescuer_admin']=='1'){
                        echo '
                            <tr>
                                <td>Rol de administrador</td>
                                <td>SI<a href="index.php?vista=rescuer_detail&rescuer_id_deta='.$datos['rescuer_id'].'&rescuer_adm" class="button is-danger is-rounded is-small">Cambiar rol Admin</a></td>
                            </tr>
                        ';
                    }else{
                        echo '
                            <tr>
                                <td>Rol de administrador</td>
                                <td>NO<a href="index.php?vista=rescuer_detail&rescuer_id_deta='.$datos['rescuer_id'].'&rescuer_adm" class="button is-danger is-rounded is-small">Cambiar rol Admin</a></td>
                            </tr>
                        ';
                    }
                }else{
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
                                <td>NO</td>
                            </tr>
                        ';
                    }
                }
                if($datos['rescuer_state']=='1'){
                    echo '
                        <tr>
                            <td>Estado del Rescuer</td>
                            <td>Activo</td>
                        </tr>
                    ';
                }else{
                    echo '
                        <tr>
                            <td>Estado del Rescuer</td>
                            <td>Inactivo</td>
                        </tr>
                    ';
                }
                
                if($_SESSION['ademin']=='1' && $check_adm['rescuer_admin']=='1'){
                    echo '
                        <tr class="has-text-centered" >
                            <td colspan="2">
                                <a href="index.php?vista=rescuer_list&rescuer_id_del='.$datos['rescuer_id'].'" class="button is-danger is-rounded is-small">Eliminar este Rescuer</a>
                            </td>
                        </tr>
                    ';
                }
            $check_rescuer=null;
            $check_adm=null;
        }
    }