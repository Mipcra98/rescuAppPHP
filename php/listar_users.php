<?php
    function listar_users(){
        //Busqueda no utilizada, pero para futuro ya está disponible
        if(isset($busqueda) && $busqueda==""){
            //$consulta_datos="SELECT * FROM user WHERE user_name LIKE '%$busqueda%' OR user_surname LIKE '%$busqueda%' OR user_dependency LIKE '%$busqueda%' OR user_company LIKE '%$busqueda%' OR user_role LIKE '%$busqueda%' ORDER BY user_id ASC";
            
            //$consulta_total="SELECT COUNT(user_id) FROM user WHERE user_name LIKE '%$busqueda%' OR user_surname LIKE '%$busqueda%' OR user_dependency LIKE '%$busqueda%' OR user_company LIKE '%$busqueda%' OR user_role LIKE '%$busqueda%'"; 
        }else{
            $consulta_datos="SELECT * FROM user ORDER BY user_id ASC";
            
            $consulta_total="SELECT COUNT(user_id) FROM user"; 
        }

        $conexion=conexion();

        $datos=$conexion->query($consulta_datos);
        $datos=$datos->fetchAll();

        $total=$conexion->query($consulta_total);
        $total=(int) $total->fetchColumn();

        if($total==0){
            echo '
                <tr class="has-text-centered has-text-black-bis" >
                    <td colspan="6">
                        <strong>No hay registros en el sistema</strong>
                    </td>
                </tr>
            ';
        }else{
            foreach($datos as $rows){
                echo '
                    <tr>
                        <td class="has-text-centered" >'.$rows['user_id'].'</td>
                        <td class="has-text-centered" >'.$rows['user_name'].'</td>
                        <td class="has-text-centered" >'.$rows['user_surname'].'</td>
                        <td class="has-text-centered" >'.$rows['user_phone'].'</td>
                        <td class="has-text-centered" >'.$rows['user_mail'].'</td>
                        <td class="has-text-centered" >
                            <a href="index.php?vista=user_detail&user_id_deta='.$rows['user_id'].'" class="button is-small" style="background-color:#FF8000;border-color:#000000"><strong class="has-text-black-bis">Ver a detalle</strong></a>
                        </td>
                    </tr>
                ';
            }

        }
        $conexion=null;
    }