<?php if(isset($_SESSION['id'])){ ?>
<div class="container">
		<?php include "./inc/btn_volver.php"; ?>
	<div class="main-container">
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos!</strong><br>
                <a>Usted no puede crear nuevos usuarios desde aquí</a>
            </div>
		</div>
</div>
<?php }else{ ?>
<div class="container">
	
	<div class="main-container box">

	<form action="./php/guardar_rescuer.php" method="POST" class="FormularioAjax" autocomplete="off" >
		<div class="container center is-fluid pb-4">
			<img class="logo-center" src="./img/rescuApp-Logo.png">
			<h1 class="title has-text-centered">RescuApp</h1>
			<h2 class="subtitle has-text-centered">Nuevo Rescuer</h2>
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
				  	<input class="input" type="text" name="rescuer_dependencia" pattern="[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ ]{3,70}" maxlength="70" placeholder="Ej: Bomberos Amarillos" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Compañía</label>
				  	<input class="input" type="text" name="rescuer_compania" pattern="[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ ]{3,70}" maxlength="70" placeholder="Ej: 2da Compañia Encarnación" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Rol en la dependencia</label>
				  	<input class="input" type="text" name="rescuer_rol" pattern="[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ ]{3,70}" maxlength="70" placeholder="Ej: Radio-Operador, 1era Respuesta, etc" required >
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
		<p class="has-text-centered">
			<button type="submit" class="button is-rounded" style="background-color:#FF8000;border-color:#000000;">Guardar</button>
		</p><br><br>
		<p class="has-text-centered mb-6 mt-2">
			Ya estas registrado como Rescuer?
			<a href="index.php?vista=login"><strong>Conectese aquí</strong></a>
		</p>
	</form>
	</div>
</div>
<?php } ?>
