<?php

	$id_adm=limpiar_cadena($_GET['rescuer_id_deta']);

    //verificar que el usuario de sesión en Admin
	$check_adm=conexion();
	$check_adm=$check_adm->query("SELECT rescuer_admin FROM rescuer WHERE rescuer_id='".$_SESSION['id']."'");
	$check_adm=$check_adm->fetch();

    if($_SESSION['ademin']=='1' && $check_adm['rescuer_admin']=='1'){ //comprobación de admin
        //verificación de existencia del rescuer
        $check_existencia=conexion();
        $check_existencia=$check_existencia->query("SELECT rescuer_id,rescuer_admin FROM rescuer WHERE rescuer_id='$id_adm'");
        if($check_existencia->rowCount()==1){

				$check_existencia=$check_existencia->fetch();

                //Cambiar Admin del Rescuer
				$cambiar_adm=conexion();
				$cambiar_adm=$cambiar_adm->prepare("UPDATE rescuer SET rescuer_admin=:adm WHERE rescuer_id='$id_adm'");

				if($check_existencia['rescuer_admin']=='0'){
					$cambiar_adm->execute([":adm"=>1]);
				}else{
					$cambiar_adm->execute([":adm"=>0]);
				}

				if($cambiar_adm->rowCount()==1){
					echo '
						<div class="notification is-success is-light">
							<strong>¡Usuario Actualizado!</strong><br>
							<a>El rescuer se pudo actualizar exitosamente</a>
						</div>
					';
				}else{
					echo '
						<div class="notification is-danger is-light">
							<strong>¡Ocurrió un error inesperado!</strong><br>
							<a>No se ha podido actualizar el rescuer, intente en unos instantes</a>
						</div>
					';
				}
				$cambiar_adm=null;
        }else{
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    <a>El usuario que intenta actualizar no existe</a>
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
    