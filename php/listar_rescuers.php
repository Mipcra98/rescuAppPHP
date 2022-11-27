<?php
    function listar_rescuers(){
        if(isset($busqueda) && $busqueda==""){
            $consulta_datos="SELECT * FROM rescuer WHERE ((rescuer_id!='".$_SESSION['id']."') AND (rescuer_name LIKE '%$busqueda%' OR rescuer_surname LIKE '%$busqueda%' OR rescuer_dependency LIKE '%$busqueda%' OR rescuer_company LIKE '%$busqueda%' OR rescuer_role LIKE '%$busqueda%')) ORDER BY rescuer_id ASC";
            
            $consulta_total="SELECT COUNT(rescuer_id) FROM rescuer WHERE ((rescuer_id!='".$_SESSION['id']."') AND (rescuer_name LIKE '%$busqueda%' OR rescuer_surname LIKE '%$busqueda%' OR rescuer_dependency LIKE '%$busqueda%' OR rescuer_company LIKE '%$busqueda%' OR rescuer_role LIKE '%$busqueda%'))"; 
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
                <tr class="has-text-centered" >
                    <td colspan="7">
                        <strong>No hay registros en el sistema</strong>
                    </td>
                </tr>
            ';
        }else{
            $contador=1;
            foreach($datos as $rows){
                echo '
                    <tr class="has-text-centered" >
                        <td>'.$contador.'</td>
                        <td>'.$rows['rescuer_name'].'</td>
                        <td>'.$rows['rescuer_surname'].'</td>
                        <td>'.$rows['rescuer_phone'].'</td>
                        <td>'.$rows['rescuer_dependency'].'</td>
                        <td>
                            <a href="index.php?vista=rescuer_update&rescuer_id_up='.$rows['rescuer_id'].'" class="button is-warning is-rounded is-small">Ver a detalle</a>
                        </td>
                        <td>
                            <a href="index.php?vista=rescuer_list&rescuer_id_del='.$rows['rescuer_id'].'" class="button is-danger is-rounded is-small">Eliminar</a>
                        </td>
                    </tr>
                ';
                $contador++;
            }

        }
        $conexion=null;
    }