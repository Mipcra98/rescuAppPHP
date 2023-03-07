<?php
    #Conexión a la BD
    function conexion(){
        $pdo = new PDO('mysql:host=localhost;dbname=rescuapp','root','');
        return $pdo;
    }

    #Verificación de datos
    function verificar_datos($filtro,$cadena){
        if(preg_match("/^".$filtro."$/",$cadena)){
            return false;
        }else{
            return true;
        }
    }

    #Limpiar cadenas de texto antes de cargar
    function limpiar_cadena($cadena){
        $cadena=trim($cadena);
        $cadena=stripslashes($cadena);
        $cadena=str_ireplace("<script>","",$cadena);
        $cadena=str_ireplace("</script>","",$cadena);
        $cadena=str_ireplace("<script src","",$cadena);
        $cadena=str_ireplace("<script type=","",$cadena);
        $cadena=str_ireplace("SELECT * FROM","",$cadena);
        $cadena=str_ireplace("DELETE FROM","",$cadena);
        $cadena=str_ireplace("INSERT INTO","",$cadena);
        $cadena=str_ireplace("DROP TABLE","",$cadena);
        $cadena=str_ireplace("DROP DATABASE","",$cadena);
        $cadena=str_ireplace("TRUNCATE TABLE","",$cadena);
        $cadena=str_ireplace("SHOW TABLES","",$cadena);
        $cadena=str_ireplace("SHOW DATABASES","",$cadena);
        $cadena=str_ireplace("<?php","",$cadena);
        $cadena=str_ireplace("?>","",$cadena);
        $cadena=str_ireplace("--","",$cadena);
        $cadena=str_ireplace("^","",$cadena);
        $cadena=str_ireplace("<","",$cadena);
        $cadena=str_ireplace("[","",$cadena);
        $cadena=str_ireplace("]","",$cadena);
        $cadena=str_ireplace("==","",$cadena);
        $cadena=str_ireplace(";","",$cadena);
        $cadena=str_ireplace("::","",$cadena);
        $cadena=trim($cadena);
        $cadena=stripslashes($cadena);
        return $cadena;
    }
    
    function fecha_ahora(){
        date_default_timezone_set('America/Asuncion');
        $fecha=date("Y-m-d H:i:s"); 
        return $fecha;
    }

    /*
    Insertar usuario
    $pdo->query("INSERT INTO user(user_ci,user_name,user_surname,user_phone,user_birthday,
    user_mail,user_blood,user_gender,user_medsInUse,user_allergies,user_nameSurnameEmergency,
    user_phoneEmergency,user_motorbikeSheet,user_carSheet,user_otherSheet) VALUES('000111999','prueba',
    'intento0','0985000000','2022-11-23','kchak@prueba.com','','','','','','','','','')");
    */
?>