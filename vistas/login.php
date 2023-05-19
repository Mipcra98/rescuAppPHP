<div class="main-container has-background-grey-light pr-6 pl-6 pb-6 pt-6">
    <form class="box login has-background-grey" action="" method="POST" autocomplete="off">
		<div class="form-rest"></div><br>
        <div class="ml-4 mr-4 columns is-centered"><img class="logo-center" src="./img/rescuApp-Logo.png"></div>
		<h5 class="title is-5 has-text-centered has-text-black-bis">RescuApp</h5>

		<div class="field">
			<label class="label has-text-black-bis">Correo electrónico</label>
			<div class="control">
			    <input class="input" type="text" name="login_correo" maxlength="70" required >
			</div>
		</div>

		<div class="field">
		  	<label class="label has-text-black-bis">Clave</label>
		  	<div class="control">
		    	<input class="input" type="password" name="login_clave" pattern="[a-zA-Z0-9$@.-]{12,100}" maxlength="100" required >
		  	</div>
		</div>

		<p class="has-text-centered mb-4 mt-3">
			<button type="submit" class="button is-normal has-text-black-bis" style="background-color:#FF8000;border-color:#000000;"><strong>Iniciar sesion</strong></button>
		</p>

		<p class="has-text-centered mb-4 mt-3 has-text-black-bis">
			Aún no te has registrado como Rescuer?
			<a href="index.php?vista=register"><strong class="has-text-white-bis">Registrate aquí</strong></a>
		</p>


		<?php
			if(isset($_POST['login_correo']) && isset($_POST['login_clave'])){
				require_once "./php/main.php";
				require_once "./php/iniciar_session.php";
			}
		?>
	</form>

</div>