<?php

	$id_state=limpiar_cadena($_GET['rescuer_id_deta']);

    //verificar que el usuario de sesión en Admin
	$check_adm=conexion();
	$check_adm=$check_adm->query("SELECT rescuer_admin FROM rescuer WHERE rescuer_id='".$_SESSION['id']."'");
	$check_adm=$check_adm->fetch();

    if($_SESSION['ademin']=='1' && $check_adm['rescuer_admin']=='1'){ //comprobación de admin
        //verificación de existencia del rescuer
        $check_existencia=conexion();
        $check_existencia=$check_existencia->query("SELECT rescuer_id,rescuer_name,rescuer_surname,rescuer_state FROM rescuer WHERE rescuer_id='$id_state'");
        if($check_existencia->rowCount()==1){

				$check_existencia=$check_existencia->fetch();

                //Cambiar State del Rescuer
				$cambiar_state=conexion();
				$cambiar_state=$cambiar_state->prepare("UPDATE rescuer SET rescuer_state=:stat WHERE rescuer_id='$id_state'");

				if($check_existencia['rescuer_state']=='0'){
					$cambiar_state->execute([":stat"=>'1']);
					$huella="Se declaró como Activo al rescuer ".ucwords($check_existencia['rescuer_name'])." ".ucwords($check_existencia['rescuer_surname'])." con rescuer_id: ".$id_state." por parte del administrador ".ucwords($_SESSION['nombre'])." ".ucwords($_SESSION['apellido'])." con rescuer_id: ".$_SESSION['id'];
				}else{
					$cambiar_state->execute([":stat"=>'0']);
					$huella="Se declaró como Inactivo al rescuer ".ucwords($check_existencia['rescuer_name'])." ".ucwords($check_existencia['rescuer_surname'])." con rescuer_id: ".$id_state." por parte del administrador ".ucwords($_SESSION['nombre'])." ".ucwords($_SESSION['apellido'])." con rescuer_id: ".$_SESSION['id'];
				}

				if($cambiar_state->rowCount()==1){
					echo '
						<div class="notification has-background-success column has-text-black-bis box">
							<strong>¡Usuario Actualizado!</strong><br>
							<p>El rescuer se pudo actualizar exitosamente</p>
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
							<p>No se ha podido actualizar el rescuer, intente en unos instantes</p>
						</div>
					';
				}
				$cambiar_state=null;
        }else{
            echo '
                <div class="notification has-background-danger column has-text-black-bis box">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    <p>El usuario que intenta actualizar no existe</p>
                </div>
            ';
        }
        $check_existencia=null;
    }else{
		echo '
			<div class="notification has-background-danger column has-text-black-bis box">
				<strong>¡Ocurrió un error inesperado!</strong><br>
				<p>Usted no puede realizar esta operación</p>
			</div>
		';
	}
	$check_adm=null;
?>
    