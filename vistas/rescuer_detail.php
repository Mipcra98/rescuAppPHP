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


<div class="container pr-6 pl-6 pb-6 pt-4 has-text-black-bis">
<div class="container columns pl-4 pr-6 is-vcentered"> 
    <?php


	
		$mostrar_rescuer=conexion();
		$mostrar_rescuer=$mostrar_rescuer->query("SELECT * FROM rescuer WHERE rescuer_id='$id'");

		if($mostrar_rescuer->rowCount()>0){
			$datos=$mostrar_rescuer->fetch();
			?>
    <div class="column is-one-quarter">
        <h1 class="title has-text-black-bis">Rescuer</h1>
        <h2 class="subtitle has-text-black-bis">Detalle del Rescuer</h2>
    </div>
            <?php
                echo '<div class="column">';
            if($_SESSION['ademin']=='1' && $check_adm['rescuer_admin'=='1']){
                if(isset($_GET['rescuer_adm'])){
                    require_once "./php/btn_rescuer_adm.php";
                }
        
                if(isset($_GET['rescuer_stat'])){
                    require_once "./php/btn_rescuer_stat.php";
                }
                echo '</div>  
                        <p class="column is-2 has-text-right">
                            <a href="index.php?vista=rescuer_detail&rescuer_id_deta='.$id.'&rescuer_stat" class="button has-text-right has-background-danger-dark is-normal has-text-black-bis" style="border-color:#000000"><strong>Cambiar Estado</strong></a>
                        </p>
                ';
                include "./inc/btn_volver.php";
    
            }else{
                echo '</div>';
                include "./inc/btn_volver.php";
            }
            
    ?>
</div>   
    <div class="table-container box has-text-black-bis has-background-grey-lighter">
        <table class="table is-striped is-hoverable is-fullwidth is-bordered has-background-grey-lighter">
            <thead>
                <tr class="has-background-grey-light">
                    <th>Nombre del campo</th>
                    <th>Valor del campo</th>
                    <th class="has-text-centered" >Acciones</th>
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
            echo '<div class="column">';
            include "./inc/notif_alerta.php";
            echo '</div>';
            include "./inc/btn_volver.php";
        }
		$mostrar_rescuer=null;
        $check_adm=null;
	?>


</div>