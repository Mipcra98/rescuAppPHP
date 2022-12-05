<?php
    function calc_edad($fecha_nac){
        date_default_timezone_set('America/Asuncion');
        $hoy=date('Y-m-d');
        
        $fecha_nac=strtotime($fecha_nac);
        $hoy=strtotime($hoy);

        $edad= ($hoy-$fecha_nac)/31536000; //60 segundos * 60 minutos * 24 horas * 365 días = 31536000 segundos por año


        return floor($edad);
    }
?>