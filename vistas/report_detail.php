<div class="container pr-6 pl-6 pb-6 pt-4 has-text-black-bis">
    <div class="container columns is-vcentered pl-4 pr-6">
        <?php
        	require_once "./php/main.php";
            
            $id_det=isset($_GET['report_id_deta']) ? $_GET['report_id_deta'] : 0 ;
        	$id_det=limpiar_cadena($id_det);
        
            //verificar datos del reporte para personalizar mensaje
                $campos="report.*,user.user_id,user.user_name,user.user_surname";
        
        		$mostrar_report=conexion();
        		$mostrar_report=$mostrar_report->query("SELECT $campos FROM report INNER JOIN user ON report.report_userId=user.user_id WHERE report_id='$id_det'");
        
        		if($mostrar_report->rowCount()>'0'){
        			$datos=$mostrar_report->fetch();
                    
                    //verificar que el usuario de sesión en Admin
                    $check_adm=conexion();
                    $check_adm=$check_adm->query("SELECT rescuer_admin FROM rescuer WHERE rescuer_id='".$_SESSION['id']."'");
                    $check_adm=$check_adm->fetch();
                    
        ?>
            
            <div class="column is-6">
                <h1 class="title has-text-black-bis">Detalle del Reporte de ID: <strong><?php echo $datos['report_id']; ?></strong></h1>
                <h2 class="subtitle has-text-black-bis">En fecha: <strong><?php echo $datos['report_dateTime']; ?></strong></h2>
            </div>
        <?php
            
            echo '<p class="column">';
        if($_SESSION['ademin']=='1' && $check_adm['rescuer_admin'=='1']){
            
            if(isset($_GET['report_stat'])){
                require_once "./php/btn_report_stat.php";
            }
            echo '</p>';
            /*if(isset($_GET['report_map'])){
                include "./php/report_map.php";
            }*/

            if($datos['report_attendend']==0 && !isset($_GET['report_stat'])){

                echo '
                    <p class="has-text-right pr-4 column is-2">
                        <a href="index.php?vista=report_detail&report_id_deta='.$id_det.'&report_stat" class="button has-text-right has-background-danger-dark is-normal has-text-black-bis" style="border-color:#000000"><strong>Atender</strong></a>
                    </p>
                ';
                
                include "./inc/btn_volver.php";
    
            }else{
                echo '</p>';
                include "./inc/btn_volver.php";
            }
        }else{
            include "./inc/btn_volver.php";
        }
        

        $check_adm=null;

            include "./php/detalle_reportes.php";
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
                    detallar_reportes($id_det);
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
		$mostrar_report=null;
	?>


</div>