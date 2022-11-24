<div class="container center is-fluid">
	<h1 class="title">Rescuer</h1>
	<h2 class="subtitle">Nuevo Rescuer</h2>
</div>
<div class="container">
	
	<div class="form-rest"></div>
	<div class="main-container">

	<form action="./php/guardar_rescuer.php" method="POST" autocomplete="off" >
		  	<div class="column">
		    	<div class="control">
					<label>C.I. del Rescuer</label>
				  	<input class="input" type="number" name="rescuer_ci" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="rescuer_name" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Apellidos</label>
				  	<input class="input" type="text" name="rescuer_surname" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Email</label>
				  	<input class="input" type="email" name="rescuer_mail" maxlength="70" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Teléfono</label>
				  	<input class="input" type="number" name="rescuer_phone" maxlength="70" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Dependencia</label>
				  	<input class="input" type="text" name="rescuer_dependency" maxlength="70" placeholder="Ej: Bomberos Amarillos" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Compañia</label>
				  	<input class="input" type="text" name="rescuer_company" maxlength="70" placeholder="Ej: 2da Compañia Encarnación" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Rol en la dependencia</label>
				  	<input class="input" type="text" name="rescuer_role" maxlength="70" placeholder="Ej: Radio-Operador, 1era Respuesta, etc" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Contraseña</label>
				  	<input class="input" type="password" name="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Repetir Contraseña</label>
				  	<input class="input" type="password" name="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required >
				</div>
		  	</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
	</div>
</div>

