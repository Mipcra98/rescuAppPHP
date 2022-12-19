<?php
    function detallar_users($user_id){
        
        $user_id=limpiar_cadena($user_id);
        
        //Verificación de user
        $check_user=conexion();
        $check_user=$check_user->query("SELECT * FROM user WHERE user_id='$user_id'");

        if($check_user->rowCount()<=0){
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    <a>El Usuario no existe en el sistema</a>
                </div>
            ';
            exit();
        }else{
            $datos=$check_user->fetch();
                echo '
                    <tr>
                        <td>ID del Usuario</td>
                        <td>'.$datos['user_id'].'</td>
                    </tr>
                    <tr>
                        <td>C.I.</td>
                        <td>'.$datos['user_ci'].'</td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td>'.$datos['user_name'].'</td>
                    </tr>
                    <tr>
                        <td>Apellido</td>
                        <td>'.$datos['user_surname'].'</td>
                    </tr>
                    <tr>
                        <td>Número de teléfono</td>
                        <td>'.$datos['user_phone'].'</td>
                    </tr>
                    <tr>
                        <td>Fecha  de Nacimiento</td>
                        <td>'.$datos['user_birthday'].'</td>
                    </tr>
                    <tr>
                        <td>Correo</td>
                        <td>'.$datos['user_mail'].'</td>
                    </tr>
                    <tr>
                        <td>Tipo de Sangre</td>
                ';
                switch($datos['user_blood']){
                    case 1:
                        echo '<td>A positivo (A+)</td>';
                        break;
                    case 2:
                        echo '<td>A negativo (A-)</td>';
                        break;
                    case 3:
                        echo '<td>B positivo (B+)</td>';
                        break;
                    case 4:
                        echo '<td>B negativo (B-)</td>';
                        break;
                    case 5:
                        echo '<td>AB positivo (AB+)</td>';
                        break;
                    case 6:
                        echo '<td>AB negativo (AB-)</td>';
                        break;
                    case 7:
                        echo '<td>O positivo (O+)</td>';
                        break;
                    case 8:
                        echo '<td>O negativo (O-)</td>';
                        break;
                    default:
                        echo '<td>No se sabe</td>';
                        break;
                }
                echo'</tr>
                    <tr>
                        <td>Género</td>';
                switch($datos['user_gender']){
                    case 1:
                        echo '<td>Masculino</td>';
                        break;
                    case 2:
                        echo '<td>Femenino</td>';
                        break;
                    default:
                        echo '<td>Otro</td>';
                        break;
                }

                echo '</tr>
                    <tr>
                        <td>Medicamentos en Uso</td>
                        <td>'.$datos['user_medsInUse'].'</td>
                    </tr>
                    <tr>
                        <td>Alergias</td>
                        <td>'.$datos['user_allergies'].'</td>
                    </tr>
                    <tr>
                        <td>Nombre y Apellido del Contacto de Emergencia</td>
                        <td>'.$datos['user_nameSurnameEmergency'].'</td>
                    </tr>
                    <tr>
                        <td>Teléfono del Contacto de Emergencia</td>
                        <td>'.$datos['user_phoneEmergency'].'</td>
                    </tr>
                    <tr>
                        <td>Nº de Chapa Motocicleta</td>
                        <td>'.$datos['user_motorbikeSheet'].'</td>
                    </tr>
                    <tr>
                        <td>Nº de Chapa Automóvil</td>
                        <td>'.$datos['user_carSheet'].'</td>
                    </tr>
                    <tr>
                        <td>Nº de Chapa Otro</td>
                        <td>'.$datos['user_otherSheet'].'</td>
                    </tr>
                ';
                
            $check_user=null;
        }
    }