<?php
	require_once "./php/main.php";

	$id=isset($_GET['rescuer_id_deta']) ? $_GET['rescuer_id_deta'] : 0 ;
	$id=limpiar_cadena($id);

    $id_session=$_SESSION['id'];
	$id_session=limpiar_cadena($id_session);

    include "./php/detalle_rescuers.php";


?>
<div class="container is-fluid">
    <h1 class="title">Rescuer</h1>
    <h2 class="subtitle">Detalle del Rescuer</h2>
</div>

<div class="container pr-6 pl-6 pb-6">

    <?php
		include "./inc/btn_volver.php";
	
		$mostrar_rescuer=conexion();
		$mostrar_rescuer=$mostrar_rescuer->query("SELECT * FROM rescuer WHERE rescuer_id='$id'");

		if($mostrar_rescuer->rowCount()>0){
			$datos=$mostrar_rescuer->fetch();
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
                    detallar_rescuers($id);
                ?>
            </tbody>
        </table>
    </div>
	
	<?php 

		}else{
			include "./inc/notif_alerta.php";
		}
		$mostrar_rescuer=null;
	?>


</div>