<?php
    function listar_reportes(){

        $campos="user.user_id,user.user_name,user.user_surname,user.user_birthday,user.user_blood,user.user_gender,report.report_id,report.report_dateTime,report.report_numberVictims,report.report_victimStatus,report.report_accidentTipe,report.report_crashTipe,report.report_runOver,report.report_userType,report.report_attendend";

        //Busqueda no utilizada, pero para futuro ya está disponible
        if(isset($busqueda) && $busqueda==""){
            //$consulta_datos="SELECT * FROM report WHERE report_id LIKE '%$busqueda%' OR  report_name LIKE '%$busqueda%' OR report_surname LIKE '%$busqueda%' OR report_dependency LIKE '%$busqueda%' OR report_company LIKE '%$busqueda%' OR report_role LIKE '%$busqueda%' ORDER BY report_id ASC";
            
            //$consulta_total="SELECT COUNT(report_id) FROM report WHERE report_id LIKE '%$busqueda%' OR report_name LIKE '%$busqueda%' OR report_surname LIKE '%$busqueda%' OR report_dependency LIKE '%$busqueda%' OR report_company LIKE '%$busqueda%' OR report_role LIKE '%$busqueda%'"; 
        }else{
            $consulta_datos="SELECT $campos FROM report INNER JOIN user ON report.report_userId=user.user_id ORDER BY report.report_dateTime ASC ";
            
            $consulta_total="SELECT COUNT(report_id) FROM report"; 
        }

        $conexion=conexion();

        $datos=$conexion->query($consulta_datos);
        $datos=$datos->fetchAll();

        $total=$conexion->query($consulta_total);
        $total=(int) $total->fetchColumn();

        if($total==0){
            echo '
                <tr class="has-text-centered" >
                    <td colspan="6">
                        <strong>No hay registros en el sistema</strong>
                    </td>
                </tr>
            ';
        }else{
            foreach($datos as $rows){
                //require_once "./php/calc_edad.php";
                

                if($rows['report_attendend']==0){ //comprobación de estado atendido o no.
                    echo '<tr class="has-text-centered is-light" style="background-color:#F78181;">';
                }else{
                    echo '<tr class="has-text-centered" >';
                }

                //impresión de los datos iniciales
                echo '
                        <td>'.$rows['report_id'].'</td>
                        <td>'.$rows['report_dateTime'].'</td>
                ';
                if($rows['report_userType']=='0'){   //impresión de tipo VÍCTIMA
                    echo '
                            <td>VÍCTIMA</td>
                            <td>'.$rows['user_name'].' '.$rows['user_surname'].', '.$rows['user_gender'].', '.$rows['user_birthday'].' años, '.$rows['user_blood'].'</td>
                    ';
                }else{   //impresión de tipo TESTIGO//verificación de casos posibles
                    /*switch($rows['report_victimStatus']){
                        case 1:
                            $estado_victima="Estado GRAVE";
                            break;
                        case 2:
                            $estado_victima="Estado LEVE";
                            break;
                        case 0:
                            $estado_victima="Estado FALLECIDO";
                            break;
                        case 0:
                            $estado_victima="Estado ILESO";
                            break;
                        default:
                            $estado_victima="No se sabe";
                            break;
                    }
                    switch($rows['report_accidentTipe']){
                        case 1:
                            $tipo_accidente="Choque";
                            break;
                        case 2:
                            $tipo_accidente="Vuelco";
                            break;
                        case 3:
                            $tipo_accidente="Arrollamiento";
                            break;
                        case 4:
                            $tipo_accidente="Otro";
                            break;
                        default:
                            $tipo_accidente="No se sabe";
                            break;
                    }
                    switch($rows['report_crashTipe']){
                        case 1:
                            $tipo_choque="Moto y Auto";
                            break;
                        case 2:
                            $tipo_choque="Moto y Bici";
                            break;
                        case 3:
                            $tipo_choque="Moto y Veh.Pesado";
                            break;
                        case 4:
                            $tipo_choque="Auto y Bici";
                            break;
                        case 5:
                            $tipo_choque="Auto y Veh.Pesado";
                            break;
                        case 6:
                            $tipo_choque="Bici y Veh.Pesado";
                            break;
                        case 7:
                            $tipo_choque="Otro";
                            break;
                        default:
                            $tipo_choque="No se sabe";
                            break;
                    }
                    switch($rows['report_runOver']){
                        case 1:
                            $arrollamiento="Persona";
                            break;
                        case 2:
                            $arrollamiento="Animal";
                            break;
                        case 3:
                            $arrollamiento="Otro";
                            break;
                        default:
                            $arrollamiento="No se sabe";
                            break;
                    }*/
                    echo '
                            <td>TESTIGO</td>
                            <td>'.$rows['report_id'].'</td>
                    ';
                }

                if($rows['report_attendend']==0){ //comprobación de estado atendido o no.
                    echo '<td>NO ATENDIDO</td>';
                }else{
                    echo '<td>Atendido</td>';
                }

                echo '
                        <td>
                            <a href="index.php?vista=report_detail&report_id_deta='.$rows['report_id'].'" class="button is-rounded is-small" style="background-color:#FF8000;border-color:#000000;">Ver a detalle</a>
                        </td>
                    </tr>
                ';
            }

        }
        $conexion=null;
    }