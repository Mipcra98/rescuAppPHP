<?php

    

    if(isset($_GET['vista'])){
        if($_GET['vista']=="DwlRescueAppAPK"){
            $nombre_archivo= "./files/RescueApp.apk";
        }
    }
    if(file_exists($nombre_archivo)){

        $mime = mime_content_type($nombre_archivo);

        header("Content-type: " . $mime);

        header("Content-Disposition: attachment; filename='RescueApp.apk'");
    
        readfile("../files/RescueApp.apk");

    }else{
        include "./inc/notif_alerta.php";
    }
?>