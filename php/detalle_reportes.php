<?php
    function detallar_reportes($id_detalle){
        $campos="report.*,user.user_id,user.user_name,user.user_surname";

            
            $id_detalle=limpiar_cadena($id_detalle);
            
            //Verificación del reporte 
            $check_report=conexion();
            $check_report=$check_report->query("SELECT $campos FROM report INNER JOIN user ON report.report_userId=user.user_id WHERE report_id='$id_detalle'");
    
            if($check_report->rowCount()<=0){
                echo '
                    <div class="notification has-background-danger column has-text-black-bis box">
                        <strong>¡Ocurrió un error inesperado!</strong><br>
                        <p>El Reporte no existe en el sistema</p>
                    </div>
                ';
                exit();
            }else{
                $datos=$check_report->fetch();
                
                switch($datos['report_victimStatus']){
                    case 2:
                        $estado_victima="GRAVE";
                        break;
                    case 3:
                        $estado_victima="LEVE";
                        break;
                    case 4:
                        $estado_victima="FALLECIDO";
                        break;
                    case 5:
                        $estado_victima="ILESO";
                        break;
                    default:
                        $estado_victima="No se sabe";
                        break;
                }

                //identificación del caso
                switch($datos['report_accidentTipe']){
                    case 2:
                        $tipo_accidente="Choque";
                        break;
                    case 3:
                        $tipo_accidente="Vuelco";
                        break;
                    case 4:
                        $tipo_accidente="Arrollamiento";
                        break;
                    case 5:
                        $tipo_accidente="Estampida";
                        break;
                    case 6:
                        $tipo_accidente="Otro";
                        break;
                    default:
                        $tipo_accidente="No se sabe";
                        break;
                }

                //identificación de choque
                switch($datos['report_crashTipe']){
                    case 2:
                        $tipo_choque="Moto y Auto";
                        break;
                    case 3:
                        $tipo_choque="Moto y Bici";
                        break;
                    case 4:
                        $tipo_choque="Moto y Veh.Pesado";
                        break;
                    case 5:
                        $tipo_choque="Auto y Bici";
                        break;
                    case 6:
                        $tipo_choque="Auto y Auto";
                        break;
                    case 7:
                        $tipo_choque="Auto y Veh.Pesado";
                        break;
                    case 8:
                        $tipo_choque="Bici y Veh.Pesado";
                        break;
                    case 9:
                        $tipo_choque="Más de dos vehiculos";
                        break;
                    case 10:
                        $tipo_choque="Otro";
                        break;
                    default:
                        $tipo_choque="No se sabe";
                        break;
                }

                //identificación de arrollamiento
                switch($datos['report_runOver']){
                    case 2:
                        $arrollamiento="afectó a una o más Personas";
                        break;
                    case 3:
                        $arrollamiento="afectó a un o más Animales";
                        break;
                    default:
                        $arrollamiento="No se sabe";
                        break;
                }

                //identificación del tipo reporte segun el usuario
                if($datos['report_userType']=='0'){
                    $tipo_user="Víctima";
                }else{
                    $tipo_user="Testigo";
                }
                    echo '
                        <tr>
                            <td>ID del reporte</td>
                            <td>'.$datos['report_id'].'</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>El usuario reportó como</td>
                            <td>'.$tipo_user.'</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Fecha de creación</td>
                            <td>'.$datos['report_dateTime'].'</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Cantidad de víctimas</td>
                            <td>'.$datos['report_numberVictims'].'</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Tipo de Accidente</td>
                            <td>'.$tipo_accidente.'</td>
                            <td></td>
                        </tr>
                    ';

                    if($tipo_accidente=="Choque"){
                        echo '
                            <tr>
                                <td>Tipo de Choque</td>
                                <td>Ocasionado entre '.$tipo_choque.'</td>
                                <td></td>
                            </tr>
                        ';
                    }elseif($tipo_accidente=="Arrollamiento"){
                        echo '
                            <tr>
                                <td>Tipo de Arrollamiento</td>
                                <td>'.$arrollamiento.'</td>
                                <td></td>
                            </tr>
                        ';
                    }else{
                        echo '
                            <tr>
                                <td>Tipo de Choque</td>
                                <td>'.$tipo_choque.'</td>
                                <td></td>
                            </tr>
                        ';
                    }
                    echo '
                        <tr>
                            <td>Esstádo de la o lás victimas</td>
                            <td>'.$estado_victima.'</td>
                            <td></td>
                        </tr>
                    ';

                    //Columna de Ubicación y sus otros posibles valores
                    if($datos['report_coordinates']==""){
                        $ubc="";
                        if($datos['report_avenue1']!=""){
                            $ubc='Avenida 1: '.$datos['report_avenue1'];
                        }
                        if($datos['report_avenue2']!=""){
                            $ubc=$ubc.' y Avenida 2: '.$datos['report_avenue2'];
                        }
                        if($datos['report_street1']!=""){
                            $ubc=$ubc.'</br>Calle 1: '.$datos['report_street1'];
                        }
                        if($datos['report_street2']!=""){
                            $ubc=$ubc.' y Calle 2: '.$datos['report_street2'];
                        }
                        if($datos['report_reference']!=""){
                            $ubc=$ubc.'</br>Referencia: '.$datos['report_reference'];
                        }
                        if($ubc==""){
                            echo '
                                <tr>
                                    <td>Ubicación</td>
                                    <td>No se registró ninguna ubicación</td>
                                    <td></td>
                                </tr>
                            ';
                        }else{
                            echo '
                                <tr>
                                    <td>Ubicación</td>
                                    <td>'.$ubc.'</td>
                                    <td></td>
                                </tr>
                            ';
                        }
                    }else{
                        echo '
                            <tr>
                                <td>Ubicación</td>
                                <td><p>'.$datos['report_coordinates'].'</p></td>';
                            echo'<td class="has-text-centered"><a href="https://www.google.es/maps/place/'.$datos['report_coordinates'].'" class="button is-small has-text-black-bis" style="background-color:#FF8000;border-color:#000000;width: 8vw;" target="_blank"><strong>Ver Mapa</strong></a> 
                                </td>
                            </tr>
                        ';
                    }

                    //identificación de caso atendido o no
                    if($datos['report_attendend']=='0'){
                        $atendido="NO Atendido";
                        echo '
                            <tr class="has-text-black-bis has-background-danger-dark">
                                <td><strong class="has-text-black-bis">Estado de solicitud</strong></td>
                                <td><strong class="has-text-black-bis">'.$atendido.'</strong></td>
                                <td></td>
                            </tr>
                        ';
                    }else{
                        $atendido="Atendido";
                        echo '
                            <tr class="has-text-black-bis">
                                <td>Estado de solicitud</td>
                                <td><strong>'.$atendido.'</strong></td>
                                <td></td>
                            </tr>
                        ';
                    }
                    echo '
                        <tr>
                            <td>Usuario que reportó</td>
                            <td>
                                <p>'.ucwords($datos['user_name']).' '.ucwords($datos['user_surname']).'   </p></td>
                            <td class="has-text-centered"><a href="index.php?vista=user_detail&user_id_deta='.$datos['user_id'].'" class="button is-small has-text-black-bis" style="background-color:#FF8000;border-color:#000000;width: 8vw;"><strong>Ver a detalle</strong></a></td>
                        </tr>
                    ';

                    //determinación de la existencia de un rescuer asociado
                    if($datos['report_rescuerId']!=""){
                        $conex_resc=conexion();
                        $conex_resc=$conex_resc->query("SELECT rescuer_id,rescuer_name,rescuer_surname FROM rescuer WHERE rescuer_id='".$datos['report_rescuerId']."'");
                        if($conex_resc->rowCount()){
                            $datos=$conex_resc->fetch();
                            echo '
                            <tr>
                                <td>Rescuer que atendió el caso</td>
                                <td><p class="pr-6">'.ucwords($datos['rescuer_name']).' '.ucwords($datos['rescuer_surname']).'   </p></td>
                                <td class="has-text-centered"><a id="view_map" href="index.php?vista=rescuer_detail&rescuer_id_deta='.$datos['rescuer_id'].'" class="button is-small has-text-black-bis" style="background-color:#FF8000;border-color:#000000;width: 8vw;"><strong>Ver a detalle</strong></a></td>
                            </tr>
                            ';
                        }else{
                            echo '
                            <tr>
                                <td colspan="3" class="has-text-centered"><strong>Aún no se asignó un Rescuer</strong></td>
                            </tr>
                            ';
                        }
                        $conex_resc=null;
                    }else{
                        echo '
                            <tr>
                                <td colspan="3" class="has-text-centered"><strong>Aún no se asignó un Rescuer</strong></td>
                            </tr>
                        ';
                    }
                    
                $check_report=null;
            }
        }