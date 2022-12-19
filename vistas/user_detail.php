
<div class="container pr-6 pl-6 pb-6">
<?php
	require_once "./php/main.php";

	$id_det=isset($_GET['user_id_deta']) ? $_GET['user_id_deta'] : 0 ;
	$id_det=limpiar_cadena($id_det);
    

    //verificar datos del usuario para personalizar mensaje
    $check_user=conexion();
    $check_user=$check_user->query("SELECT * FROM user WHERE user_id='".$id_det."'");

	if($check_user->rowCount()>0){
		$datos=$check_user->fetch();
            
    include "./php/detalle_users.php";
    ?>

    <div class="container is-fluid">
        <h1 class="title">Usuario</h1>
        <h2 class="subtitle">Detalle del Usuario <?php echo $datos['user_name'].' '.$datos['user_surname']; ?></h2>
    </div>
    
    <?php
        include "./inc/btn_volver.php";
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
            include "./inc/btn_volver.php";
            include "./inc/notif_alerta.php";
        }
		$mostrar_user=null;
	?>


</div>