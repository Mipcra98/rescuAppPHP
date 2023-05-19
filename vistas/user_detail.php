
<div class="container pr-6 pl-6 pb-6 pt-4 has-text-black-bis">
    <div class="container columns is-vcentered pl-4 pr-6">
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
    
        <div class="column is-half">
            <h1 class="title has-text-black-bis">Usuario</h1>
            <h2 class="subtitle has-text-black-bis"><?php echo $datos['user_name'].' '.$datos['user_surname']; ?></h2>
        </div>
          
        <?php
            echo '<div class="column"></div>';
            include "./inc/btn_volver.php";
        ?>
    </div>   
    <div class="table-container box has-text-black-bis has-background-grey-lighter">
        <table class="table is-striped is-hoverable is-fullwidth is-bordered has-background-grey-lighter">
            <thead>
                <tr class="has-text-centered has-background-grey-light">
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
            echo '<div class="column">';
            include "./inc/notif_alerta.php";
            echo '</div>';
            include "./inc/btn_volver.php";
        }
		$mostrar_user=null;
	?>


</div>