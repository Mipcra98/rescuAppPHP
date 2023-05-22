<?php if(isset($_SESSION['id'])){ ?>
<div class="container pr-6 pl-6 pb-6 pt-6">
		<?php include "./inc/btn_volver.php"; ?>
	<div class="main-container box has-text-black-bis has-background-grey-lighter">
        <div class="notification is-danger is-light has-text-black-bis">
            <strong>¡Lo sentimos!</strong><br>
            <p>Usted no puede crear nuevos usuarios desde aquí</p>
        </div>
	</div>
</div>
<?php }else{ ?>
<div class="container pr-6 pl-6 pb-6 pt-6">
	
	<div class="main-container box has-text-black-bis has-background-grey-lighter pr-6 pl-6">

	<form action="./php/guardar_rescuer.php" method="POST" class="FormularioAjax" autocomplete="off" >
		<div class="container center is-fluid pb-4">
		    <div class="ml-4 mr-4 columns is-centered">
			    <img class="logo-center" src="./img/rescuApp-Logo.png">
			</div>
			<h1 class="title has-text-centered has-text-black-bis">RescuApp</h1>
			<h2 class="subtitle has-text-centered has-text-black-bis">Nuevo Rescuer</h2>
		</div>
		  	<div class="column">
		    	<div class="control">
					<label>C.I. del Rescuer</label>
				  	<input class="input" type="number" name="rescuer_ci" pattern="[0-9 ]{3,40}" maxlength="40" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="rescuer_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ ]{3,40}" maxlength="40" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Apellidos</label>
				  	<input class="input" type="text" name="rescuer_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ ]{3,40}" maxlength="40" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Correo electrónico</label>
				  	<input class="input" type="email" name="rescuer_correo" minlength="10" maxlength="70" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Teléfono</label>
				  	<input class="input" type="number" name="rescuer_telefono" pattern="[0-9$@.-]{8,15}" minlength="8" maxlength="15" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Dependencia</label>
				  	<input class="input" type="text" name="rescuer_dependencia" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ ]{3,70}" maxlength="70" placeholder="Ej: CBVCE" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Compañía</label>
				  	<input class="input" type="text" name="rescuer_compania" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ ]{3,70}" maxlength="70" placeholder="Ej: 1era Compañia Encarnación" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Rol en la dependencia</label>
				  	<input class="input" type="text" name="rescuer_rol" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ ]{3,70}" maxlength="70" placeholder="Ej: Radio-Operador, 1era Respuesta, etc" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Contraseña</label>
				  	<input class="input" type="password" name="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{12,100}" minlength="12" maxlength="100" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Repetir Contraseña</label>
				  	<input class="input" type="password" name="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{12,100}" minlength="12" maxlength="100" required >
				</div>
		  	</div>
		<div class="form-rest"></div>
		<p class="has-text-centered mb-4 mt-3">
			<button type="submit" class="button is-normal has-text-black-bis" style="background-color:#FF8000;border-color:#000000;"><strong>Guardar</strong></button>
		</p>
		<p class="has-text-centered mb-4 mt-3 has-text-black-bis">
			Ya estas registrado como Rescuer?
			<a href="index.php?vista=login"><strong class="has-text-black-bis">Conectese aquí</strong></a>
		</p>
	</form>
	</div>
</div>
<?php } ?>
