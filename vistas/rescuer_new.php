<div class="container center is-fluid">
	<h1 class="title">Rescuer</h1>
	<h2 class="subtitle">Nuevo Rescuer</h2>
</div>
<div class="container">
	
	<div class="main-container">

	<form action="./php/guardar_rescuer.php" method="POST" class="FormularioAjax" autocomplete="off" >
		  	<div class="column">
		    	<div class="control">
					<label>C.I. del Rescuer</label>
				  	<input class="input" type="number" name="rescuer_ci" pattern="[0-9 ]{3,40}" maxlength="40" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="rescuer_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Apellidos</label>
				  	<input class="input" type="text" name="rescuer_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Correo electrónico</label>
				  	<input class="input" type="email" name="rescuer_correo" maxlength="70" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Teléfono</label>
				  	<input class="input" type="number" name="rescuer_telefono" pattern="[0-9$@.-]{8,15}" maxlength="70" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Dependencia</label>
				  	<input class="input" type="text" name="rescuer_dependencia" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,70}" maxlength="70" placeholder="Ej: Bomberos Amarillos" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Compañía</label>
				  	<input class="input" type="text" name="rescuer_compania" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,70}" maxlength="70" placeholder="Ej: 2da Compañia Encarnación" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Rol en la dependencia</label>
				  	<input class="input" type="text" name="rescuer_rol" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,70}" maxlength="70" placeholder="Ej: Radio-Operador, 1era Respuesta, etc" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Contraseña</label>
				  	<input class="input" type="password" name="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{12,100}" maxlength="100" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Repetir Contraseña</label>
				  	<input class="input" type="password" name="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{12,100}" maxlength="100" required >
				</div>
		  	</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p><br>
		<div class="form-rest"></div>
	</form>
	<p class="has-text-centered mb-4 mt-3">
		Ya estas registrado como Rescuer?
		<a href="index.php?vista=login"><strong>Conectese aquí</strong></a>
	</p>
	</div>
</div>

