<?php

	$id_state=limpiar_cadena($_GET['report_id_deta']);

    //verificar que el usuario de sesión en Admin
	$check_adm=conexion();
	$check_adm=$check_adm->query("SELECT rescuer_id,rescuer_admin FROM rescuer WHERE rescuer_id='".$_SESSION['id']."'");
	$check_adm=$check_adm->fetch();

    if($_SESSION['ademin']=='1' && $check_adm['rescuer_admin']=='1'){ //comprobación de admin
        //verificación de existencia del rescuer
        $check_existencia=conexion();
        $check_existencia=$check_existencia->query("SELECT report_id,report_attendend FROM report WHERE report_id='$id_state'");
        if($check_existencia->rowCount()==1){

				$check_existencia=$check_existencia->fetch();

                //Cambiar State del Rescuer
				$cambiar_state=conexion();
				$cambiar_state=$cambiar_state->prepare("UPDATE report SET report_attendend=:stat,report_rescuerId=:rescu_id WHERE report_id='$id_state'");

				$rescu_id=intval($check_adm['rescuer_id']);
				$cambiar_state->execute([":stat"=>'1',":rescu_id"=>$rescu_id]);

				if($cambiar_state->rowCount()==1){
					echo '
						<div class="notification is-success is-light">
							<strong>¡Reporte Atendido!</strong><br>
							<a>El reporte se pudo actualizar exitosamente</a>
						</div>
					';
				}else{
					echo '
						<div class="notification is-danger is-light">
							<strong>¡Ocurrió un error inesperado!</strong><br>
							<a>No se ha podido atender el reporte, intente en unos instantes</a>
						</div>
					';
				}
				$cambiar_state=null;
        }else{
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    <a>El reporte que intenta atender no existe</a>
                </div>
            ';
        }
        $check_existencia=null;
    }else{
		echo '
			<div class="notification is-danger is-light">
				<strong>¡Ocurrió un error inesperado!</strong><br>
				<a>Usted no puede realizar esta operación</a>
			</div>
		';
	}
	$check_adm=null;
?>
    