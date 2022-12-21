<?php
	require_once "./php/main.php";

	$id=isset($_GET['rescuer_id_up']) ? $_GET['rescuer_id_up'] : 0 ;
	$id=limpiar_cadena($id);


?>

<div class="container is-fluid">
	<h1 class="title">Rescuer</h1>
	<h2 class="subtitle">Actualizar mi perfil</h2>
</div>

<div class="container pr-6 pl-6 pb-6">

	<?php 

		include "./inc/btn_volver.php";
	
		$check_rescuer=conexion();
		$check_rescuer=$check_rescuer->query("SELECT * FROM rescuer WHERE rescuer_id='$id'");

		if($check_rescuer->rowCount()>0 AND $_SESSION['id']==$id){
			$datos=$check_rescuer->fetch();
		

	?>

	<div class="main-container box">
		<form action="./php/actualizar_rescuer.php" method="POST" class="FormularioAjax" autocomplete="off" >
			<input type="hidden" value="<?php echo $datos['rescuer_id']; ?>" name="rescuer_id" required >
			<div class="columns">
				<div class="column">
					<div class="control">
						<label>C.I. del Rescuer</label>
						<input class="input" type="number" value="<?php echo $datos['rescuer_ci']; ?>" name="rescuer_ci" pattern="[0-9 ]{3,40}" maxlength="40" required >
					</div>
				</div>
				<div class="column">
					<div class="control">
						<label>Nombre</label>
						<input class="input" type="text" value="<?php echo $datos['rescuer_name']; ?>" name="rescuer_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ ]{3,40}" maxlength="40" required >
					</div>
				</div>
			</div>
			<div class="columns">
				<div class="column">
					<div class="control">
						<label>Apellidos</label>
						<input class="input" type="text" value="<?php echo $datos['rescuer_surname']; ?>" name="rescuer_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ ]{3,40}" maxlength="40" required >
					</div>
				</div>
				<div class="column">
					<div class="control">
						<label>Correo electrónico</label>
						<input class="input" type="email" value="<?php echo $datos['rescuer_mail']; ?>" name="rescuer_nuevo_correo" maxlength="70" required >
					</div>
				</div>
			</div>
			<div class="columns">
				<div class="column">
					<div class="control">
						<label>Teléfono</label>
						<input class="input" type="number" value="<?php echo $datos['rescuer_phone']; ?>" name="rescuer_telefono" pattern="[0-9$@.-]{8,15}" maxlength="70" required >
					</div>
				</div>
				<div class="column">
					<div class="control">
						<label>Dependencia</label>
						<input class="input" type="text" value="<?php echo $datos['rescuer_dependency']; ?>" name="rescuer_dependencia" pattern="[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ ]{3,70}" maxlength="70" placeholder="Ej: Bomberos Amarillos" required >
					</div>
				</div>
			</div>
			<div class="columns">
				<div class="column">
					<div class="control">
						<label>Compañía</label>
						<input class="input" type="text" value="<?php echo $datos['rescuer_company']; ?>" name="rescuer_compania" pattern="[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ ]{3,70}" maxlength="70" placeholder="Ej: 2da Compañia Encarnación" required >
					</div>
				</div>
				<div class="column">
					<div class="control">
						<label>Rol en la dependencia</label>
						<input class="input" type="text" value="<?php echo $datos['rescuer_role']; ?>" name="rescuer_rol" pattern="[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ ]{3,70}" maxlength="70" placeholder="Ej: Radio-Operador, 1era Respuesta, etc" required >
					</div>
				</div>
			</div><br><br>
			<strong>En caso usted desee cambiar su contraña de acceso cargue en estos campos, en caso que no lo desee hacer deje los campos vacíos</strong>
			<div class="columns">
				<div class="column">
					<div class="control">
						<label>Nueva ontraseña</label>
						<input class="input" type="password" name="usuario_clave_nueva_1" pattern="[a-zA-Z0-9$@.-]{12,100}" maxlength="100">
					</div>
				</div>
				<div class="column">
					<div class="control">
						<label>Repetir nueva contraseña</label>
						<input class="input" type="password" name="usuario_clave_nueva_2" pattern="[a-zA-Z0-9$@.-]{12,100}" maxlength="100">
					</div>
				</div>
			</div><br><br>
			<strong>Para confirmar los cambios deberá cargar en este apartado los datos con los que ingresó anteriormente</strong>
			<div class="columns">
				<div class="column">
					<div class="control">
						<label>Correo electrónico</label>
						<input class="input" type="email" name="rescuer_correo" maxlength="70" required >
					</div>
				</div>
				<div class="column">
					<div class="control">
						<label>Contraseña</label>
						<input class="input" type="password" name="usuario_clave" pattern="[a-zA-Z0-9$@.-]{12,100}" maxlength="100" required >
					</div>
				</div>
			</div>
			<div class="form-rest"></div><br><br>
			<p class="has-text-centered">
				<button type="submit" class="button is-rounded" style="background-color:#FF8000;border-color:#000000;">Actualizar</button>
			</p>
		</form>
	</div>
	
	<?php 

		}else{
            include "./inc/btn_volver.php";
			include "./inc/notif_alerta.php";
		}
		$check_rescuer=null;
	?>
</div>