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
                        <td>ID del Rescuer</td>
                        <td>'.$datos['rescuer_id'].'</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>C.I.</td>
                        <td>'.$datos['rescuer_ci'].'</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td>'.$datos['rescuer_name'].'</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Apellido</td>
                        <td>'.$datos['rescuer_surname'].'</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Número de teléfono</td>
                        <td>'.$datos['rescuer_phone'].'</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Correo</td>
                        <td>'.$datos['rescuer_mail'].'</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Dependencia</td>
                        <td>'.$datos['rescuer_dependency'].'</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Compañía</td>
                        <td>'.$datos['rescuer_company'].'</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Rol en la compañía</td>
                        <td>'.$datos['rescuer_role'].'</td>
                        <td></td>
                    </tr>
                ';
                if($_SESSION['ademin']=='1' && $check_adm['rescuer_admin']=='1'){
                    if($datos['rescuer_admin']=='1'){
                        echo '
                            <tr>
                                <td>Rol de administrador</td>
                                <td><p class="pr-6 is">SI  </p></td>
                                <td><a href="index.php?vista=rescuer_detail&rescuer_id_deta='.$datos['rescuer_id'].'&rescuer_adm" class="button is-danger is-rounded is-small">Cambiar rol Administrador</a></td>
                            </tr>
                        ';
                    }else{
                        echo '
                            <tr>
                                <td>Rol de administrador</td>
                                <td><p class="pr-6">NO  </p></td>
                                <td><a href="index.php?vista=rescuer_detail&rescuer_id_deta='.$datos['rescuer_id'].'&rescuer_adm" class="button is-danger is-rounded is-small">Cambiar rol Administrador</a></td>
                            </tr>
                        ';
                    }
                }else{
                    if($datos['rescuer_admin']=='1'){
                        echo '
                            <tr>
                                <td>Rol de administrador</td>
                                <td>SI</td>
                                <td></td>
                            </tr>
                        ';
                    }else{
                        echo '
                            <tr>
                                <td>Rol de administrador</td>
                                <td>NO</td>
                                <td></td>
                            </tr>
                        ';
                    }
                }
                if($datos['rescuer_state']=='1'){
                    echo '
                        <tr>
                            <td>Estado del Rescuer</td>
                            <td>Activo</td>
                            <td></td>
                        </tr>
                    ';
                }else{
                    echo '
                        <tr>
                            <td>Estado del Rescuer</td>
                            <td>Inactivo</td>
                            <td></td>
                        </tr>
                    ';
                }
                
                if($_SESSION['ademin']=='1' && $check_adm['rescuer_admin']=='1'){
                    echo '
                        <tr class="has-text-centered" >
                            <td colspan="3">
                                <a href="index.php?vista=rescuer_list&rescuer_id_del='.$datos['rescuer_id'].'" class="button is-danger is-rounded is-small">Eliminar este Rescuer</a>
                            </td>
                        </tr>
                    ';
                }
            $check_rescuer=null;
            $check_adm=null;
        }
    }