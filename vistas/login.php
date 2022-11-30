<div class="main-container">

    <form class="box login" action="" method="POST" autocomplete="off">
        <img class="logo-center" src="./img/rescuApp-Logo.png">
		<h5 class="title is-5 has-text-centered is-uppercase">RescuApp</h5>

		<div class="field">
			<label class="label">Correo electrónico</label>
			<div class="control">
			    <input class="input" type="text" name="login_correo" maxlength="70" required >
			</div>
		</div>

		<div class="field">
		  	<label class="label">Clave</label>
		  	<div class="control">
		    	<input class="input" type="password" name="login_clave" pattern="[a-zA-Z0-9$@.-]{12,100}" maxlength="100" required >
		  	</div>
		</div>

		<p class="has-text-centered mb-4 mt-3">
			<button type="submit" class="button is-info is-rounded">Iniciar sesion</button>
		</p>

		<p class="has-text-centered mb-4 mt-3">
			Aún no te has registrado como Rescuer?
			<a href="index.php?vista=register"><strong>Registrate aquí</strong></a>
		</p>


		<?php
			if(isset($_POST['login_correo']) && isset($_POST['login_clave'])){
				require_once "./php/main.php";
				require_once "./php/iniciar_session.php";
			}
		?>
	</form>

</div>