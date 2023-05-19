<?php
    function listar_reportes(){

        $campos="user.user_id,user.user_name,user.user_surname,user.user_birthday,user.user_blood,user.user_gender,report.report_id,report.report_dateTime,report.report_numberVictims,report.report_victimStatus,report.report_accidentTipe,report.report_crashTipe,report.report_runOver,report.report_userType,report.report_attendend";

        //Busqueda no utilizada, pero para futuro ya está disponible
        if(isset($busqueda) && $busqueda==""){
            //$consulta_datos="SELECT * FROM report WHERE report_id LIKE '%$busqueda%' OR  report_name LIKE '%$busqueda%' OR report_surname LIKE '%$busqueda%' OR report_dependency LIKE '%$busqueda%' OR report_company LIKE '%$busqueda%' OR report_role LIKE '%$busqueda%' ORDER BY report_id ASC";
            
            //$consulta_total="SELECT COUNT(report_id) FROM report WHERE report_id LIKE '%$busqueda%' OR report_name LIKE '%$busqueda%' OR report_surname LIKE '%$busqueda%' OR report_dependency LIKE '%$busqueda%' OR report_company LIKE '%$busqueda%' OR report_role LIKE '%$busqueda%'"; 
        }else{
            $consulta_datos="SELECT $campos FROM report INNER JOIN user ON report.report_userId=user.user_id ORDER BY report.report_attendend ASC,report.report_dateTime DESC";
            
            $consulta_total="SELECT COUNT(report_id) FROM report"; 
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
                require_once "./php/calc_edad.php";
                $edad=calc_edad($rows['user_birthday']);    //Calculo de edad del usuario

                switch($rows['user_blood']){   //definición de sangre del usuario
                    case 1:
                        $blood="A positivo (A+)";
                        break;
                    case 2:
                        $blood="A negativo (A-)";
                        break;
                    case 3:
                        $blood="B positivo (B+)";
                        break;
                    case 4:
                        $blood="B negativo (B-)";
                        break;
                    case 5:
                        $blood="AB positivo (AB+)";
                        break;
                    case 6:
                        $blood="AB negativo (AB-)";
                        break;
                    case 7:
                        $blood="O positivo (O+)";
                        break;
                    case 8:
                        $blood="O negativo (O-)";
                        break;
                    default:
                        $blood="Sangre: No se sabe";
                        break;
                }

                //definición de género
                switch($rows['user_gender']){
                    case 1:
                        $genero_usuario="Masculino";
                        break;
                    case 2:
                        $genero_usuario="Femenino";
                        break;
                    default:
                        $genero_usuario="No se sabe o no se identifica";
                        break;
                }

                //Muestra adecuada de fecha y hora
                $fecha_reg=strtotime($rows['report_dateTime']);
                $fecha_evento=date("Y-m-d H:i:s", $fecha_reg);

                if($rows['report_attendend']==0){ //comprobación de estado atendido o no.
                    echo '<tr class="has-text-centered has-text-black-bis has-background-danger-dark">';
                }else{
                    echo '<tr class="has-text-centered has-text-black-bis" >';
                }

                //impresión de los datos iniciales
                echo '
                        <td>'.$rows['report_id'].'</td>
                        <td>'.$fecha_evento.'</td>
                ';
                if($rows['report_userType']=='0'){   //impresión de tipo VÍCTIMA
                    echo '
                            <td><strong class="has-text-black-bis">VÍCTIMA</strong></td>
                            <td>'.$rows['user_name'].' '.$rows['user_surname'].'__'.$genero_usuario.'__'.$edad.' años__'.$blood.'</td>
                    ';
                }else{   //impresión de tipo TESTIGO
                    
                    //identificación del estado de la/s victima/s
                    switch($rows['report_victimStatus']){
                        case 2:
                            $estado_victima="Estado: GRAVE";
                            break;
                        case 3:
                            $estado_victima="Estado: LEVE";
                            break;
                        case 4:
                            $estado_victima="Estado: FALLECIDO";
                            break;
                        case 5:
                            $estado_victima="Estado: ILESO";
                            break;
                        default:
                            $estado_victima="Estado: No se sabe";
                            break;
                    }

                    //identificación del caso
                    switch($rows['report_accidentTipe']){
                        case 2:
                            $tipo_accidente="Choque:";
                            break;
                        case 3:
                            $tipo_accidente="Vuelco";
                            break;
                        case 4:
                            $tipo_accidente="Arrollamiento:";
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
                    switch($rows['report_crashTipe']){
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
                    switch($rows['report_runOver']){
                        case 2:
                            $arrollamiento="Persona";
                            break;
                        case 3:
                            $arrollamiento="Animal";
                            break;
                        default:
                            $arrollamiento="No se sabe";
                            break;
                    }

                    //personalizar mensaje de acuerdo al caso
                    if($tipo_accidente == "Choque:"){
                        $caso = $tipo_accidente.' '.$tipo_choque;
                    }elseif($tipo_accidente == "Arrollamiento:"){
                        $caso = $tipo_accidente.' '.$arrollamiento;
                    }else{
                        $caso = $tipo_accidente;
                    }

                    echo '
                            <td><strong class="has-text-black-bis">TESTIGO</strong></td>
                            <td>'.$rows['report_numberVictims'].' victimas__'.$estado_victima.'__'.$caso.'</td>
                            
                    ';  //report.report_accidentTipe,report.report_crashTipe,report.report_runOver
                }

                if($rows['report_attendend']==0){ //comprobación de estado atendido o no.
                    echo '<td><strong class="has-text-black-bis">NO ATENDIDO</strong></td>';
                }else{
                    echo '<td>Atendido</td>';
                }

                echo '
                        <td>
                            <a href="index.php?vista=report_detail&report_id_deta='.$rows['report_id'].'" class="button is-small" style="background-color:#FF8000;border-color:#000000"><strong class="has-text-black-bis">Ver a detalle</strong></a>
                        </td>
                    </tr>
                ';
            }

        }
        $conexion=null;
    }