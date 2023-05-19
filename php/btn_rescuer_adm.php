<?php

	$id_adm=limpiar_cadena($_GET['rescuer_id_deta']);

    //verificar que el usuario de sesión en Admin
	$check_adm=conexion();
	$check_adm=$check_adm->query("SELECT rescuer_admin FROM rescuer WHERE rescuer_id='".$_SESSION['id']."'");
	$check_adm=$check_adm->fetch();

    if($_SESSION['ademin']=='1' && $check_adm['rescuer_admin']=='1'){ //comprobación de admin
        //verificación de existencia del rescuer
        $check_existencia=conexion();
        $check_existencia=$check_existencia->query("SELECT rescuer_id,rescuer_name,rescuer_surname,rescuer_admin FROM rescuer WHERE rescuer_id='$id_adm'");
        if($check_existencia->rowCount()==1){

				$check_existencia=$check_existencia->fetch();

                //Cambiar Admin del Rescuer
				$cambiar_adm=conexion();
				$cambiar_adm=$cambiar_adm->prepare("UPDATE rescuer SET rescuer_admin=:adm WHERE rescuer_id='$id_adm'");

				if($check_existencia['rescuer_admin']=='0'){
					$cambiar_adm->execute([":adm"=>1]);
					$huella="Se otorgó el acceso de Administrador al rescuer ".ucwords($check_existencia['rescuer_name'])." ".ucwords($check_existencia['rescuer_surname'])." con rescuer_id: ".$id_adm." por parte del administrador ".ucwords($_SESSION['nombre'])." ".ucwords($_SESSION['apellido'])." con rescuer_id: ".$_SESSION['id'];
				}else{
					$cambiar_adm->execute([":adm"=>0]);
					$huella="Se retiró el acceso de Administrador al rescuer ".ucwords($check_existencia['rescuer_name'])." ".ucwords($check_existencia['rescuer_surname'])." con rescuer_id: ".$id_adm." por parte del administrador ".ucwords($_SESSION['nombre'])." ".ucwords($_SESSION['apellido'])." con rescuer_id: ".$_SESSION['id'];
				}

				if($cambiar_adm->rowCount()==1){
					echo '
						<div class="notification has-background-success column has-text-black-bis box">
							<strong>¡Usuario Actualizado!</strong><br>
							<a>El rescuer se pudo actualizar exitosamente</a>
						</div>
					';

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
				}else{
					echo '
						<div class="notification has-background-danger column has-text-black-bis box">
							<strong>¡Ocurrió un error inesperado!</strong><br>
							<a>No se ha podido actualizar el rescuer, intente en unos instantes</a>
						</div>
					';
				}
				$cambiar_adm=null;
        }else{
            echo '
                <div class="notification has-background-danger column has-text-black-bis box">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    <a>El usuario que intenta actualizar no existe</a>
                </div>
            ';
        }
        $check_existencia=null;
    }else{
		echo '
			<div class="notification has-background-danger column has-text-black-bis box">
				<strong>¡Ocurrió un error inesperado!</strong><br>
				<a>Usted no puede realizar esta operación</a>
			</div>
		';
	}
	$check_adm=null;
?>
    