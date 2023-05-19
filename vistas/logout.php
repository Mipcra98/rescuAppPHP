<?php
    require_once "./php/main.php";

    $huella="Cierre de Sesión por el rescuer ".ucwords($_SESSION['nombre'])." ".ucwords($_SESSION['apellido'])." con rescuer_id: ".$_SESSION['id'];

    $tipo="Rescuers";

    $marc_audit=[
    ":fecha"=>fecha_ahora(),
    ":huella"=>$huella,
    ":afecta"=>$tipo,
    ];
    $guardar_huella=conexion();
    $guardar_huella=$guardar_huella->prepare("INSERT INTO auditTrail(auditTrail_dateTime,auditTrail_detail,auditTrail_affectTo) VALUES 
    (:fecha,:huella,:afecta)");

    $guardar_huella->execute($marc_audit);
    $guardar_huella=null;

    session_destroy();

    if(headers_sent()){
        echo "<script> window.location.href='index.php?vista=login';</script>";
    }else{
        header("Location: index.php?vista=login");
    }