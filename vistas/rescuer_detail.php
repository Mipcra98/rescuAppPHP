<?php
	require_once "./php/main.php";

	$id=isset($_GET['rescuer_id_deta']) ? $_GET['rescuer_id_deta'] : 0 ;
	$id=limpiar_cadena($id);

    //verificar que el usuario de sesión en Admin
    $check_adm=conexion();
    $check_adm=$check_adm->query("SELECT rescuer_admin FROM rescuer WHERE rescuer_id='".$_SESSION['id']."'");
    $check_adm=$check_adm->fetch();

    include "./php/detalle_rescuers.php";


?>
<div class="container is-fluid">
    <h1 class="title">Rescuer</h1>
    <h2 class="subtitle">Detalle del Rescuer</h2>
</div>

<div class="container pr-6 pl-6 pb-6">
    
    <?php

        if($_SESSION['ademin']=='1' && $check_adm['rescuer_admin'=='1']){
            echo '
                <div class="columns is-gapless">
                    <p class="column is-half"></p>
                    <p class="has-text-right pr-4 column is-one-quarter">
                        <a href="index.php?vista=rescuer_detail&rescuer_id_deta='.$id.'&rescuer_stat" class="button is-info is-rounded"><strong>Cambiar Estado</strong></a>
                    </p>
            ';
                include "./inc/btn_volver.php";

            echo '</div>';
        }else{
            include "./inc/btn_volver.php";
        }
        $check_adm=null;

        if(isset($_GET['rescuer_adm'])){
            require_once "./php/btn_admin.php";
        }

        if(isset($_GET['rescuer_stat'])){
            require_once "./php/btn_stat.php";
        }
	
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