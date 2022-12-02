<?php
    function calc_edad($fecha_nac){
        $hoy = new date();
        $hoy->format('Y-m-d');
        
        $fecha_nac=strtotime($fecha_nac);
        $hoy=strtotime($hoy);

        $edad= ($fecha_nac-$hoy)/31536000; //60 segundos * 60 minutos * 24 horas * 365 días = 31536000 segundos por año

        return $edad;
    }
?>