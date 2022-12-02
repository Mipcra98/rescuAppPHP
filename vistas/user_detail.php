<?php
	require_once "./php/main.php";

	$id_det=isset($_GET['user_id_deta']) ? $_GET['user_id_deta'] : 0 ;
	$id_det=limpiar_cadena($id_det);

    //verificar datos del usuario para personalizar mensaje
    $check_user=conexion();
    $check_user=$check_user->query("SELECT user_name,user_surname FROM user WHERE user_id='".$id_det."'");
    $check_user=$check_user->fetch();

    include "./php/detalle_users.php";


?>
<div class="container is-fluid">
    <h1 class="title">Usuario</h1>
    <h2 class="subtitle">Detalle del Usuario <?php echo $check_user['user_name'].' '.$check_user['user_surname']; ?></h2>
</div>

<div class="container pr-6 pl-6 pb-6">
    
    <?php

        include "./inc/btn_volver.php";
        $check_user=null;

		$mostrar_user=conexion();
		$mostrar_user=$mostrar_user->query("SELECT * FROM user WHERE user_id='$id_det'");

		if($mostrar_user->rowCount()>0){
			$datos=$mostrar_user->fetch();
    ?>

    <div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr class="has-text-centered">
                    <th>Nombre del campo</th>
                    <th>Valor del campo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    detallar_users($id_det);
                ?>
            </tbody>
        </table>
    </div>
	
	<?php 
        }else{
            include "./inc/notif_alerta.php";
        }
		$mostrar_user=null;
	?>


</div>