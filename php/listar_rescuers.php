<?php
    function listar_rescuers(){
        //Busqueda no utilizada, pero para futuro ya está disponible
        if(isset($busqueda) && $busqueda==""){
            //$consulta_datos="SELECT * FROM rescuer WHERE ((rescuer_id!='".$_SESSION['id']."') AND (rescuer_name LIKE '%$busqueda%' OR rescuer_surname LIKE '%$busqueda%' OR rescuer_dependency LIKE '%$busqueda%' OR rescuer_company LIKE '%$busqueda%' OR rescuer_role LIKE '%$busqueda%')) ORDER BY rescuer_id ASC";
            
            //$consulta_total="SELECT COUNT(rescuer_id) FROM rescuer WHERE ((rescuer_id!='".$_SESSION['id']."') AND (rescuer_name LIKE '%$busqueda%' OR rescuer_surname LIKE '%$busqueda%' OR rescuer_dependency LIKE '%$busqueda%' OR rescuer_company LIKE '%$busqueda%' OR rescuer_role LIKE '%$busqueda%'))"; 
        }else{
            $consulta_datos="SELECT * FROM rescuer WHERE rescuer_id!='".$_SESSION['id']."' ORDER BY rescuer_id ASC";
            
            $consulta_total="SELECT COUNT(rescuer_id) FROM rescuer WHERE rescuer_id!='".$_SESSION['id']."'"; 
        }

        $conexion=conexion();

        $datos=$conexion->query($consulta_datos);
        $datos=$datos->fetchAll();

        $total=$conexion->query($consulta_total);
        $total=(int) $total->fetchColumn();

        if($total==0){
            echo '
                <tr class="has-text-centered has-text-black-bis" >
                    <td colspan="7">
                        <strong>No hay registros en el sistema</strong>
                    </td>
                </tr>
            ';
        }else{
            foreach($datos as $rows){
                echo '
                    <tr>
                        <td class="has-text-centered" >'.$rows['rescuer_id'].'</td>
                        <td class="has-text-centered" >'.$rows['rescuer_name'].'</td>
                        <td class="has-text-centered" >'.$rows['rescuer_surname'].'</td>
                        <td class="has-text-centered" >'.$rows['rescuer_phone'].'</td>
                        <td class="has-text-centered" >'.$rows['rescuer_dependency'].'</td>
                        <td class="has-text-centered" >
                            <a href="index.php?vista=rescuer_detail&rescuer_id_deta='.$rows['rescuer_id'].'" class="button is-small" style="background-color:#FF8000;border-color:#000000"><strong class="has-text-black-bis">Ver a detalle</strong></a>
                        </td>
                    </tr>
                ';
            }

        }
        $conexion=null;
    }