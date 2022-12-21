<div class="container pr-6 pl-6 pb-6">
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
            <div class="container is-fluid">
                <h2 class="subtitle">Detalle del Reporte de ID: <strong><?php echo $datos['report_id'].'</strong>, en fecha: <strong>'.$datos['report_dateTime']; ?></strong></h2>
            </div>
        <?php

            
        if($_SESSION['ademin']=='1' && $check_adm['rescuer_admin'=='1']){
            
            if(isset($_GET['report_stat'])){
                require_once "./php/btn_report_stat.php";
            }

            /*if(isset($_GET['report_map'])){
                include "./php/report_map.php";
            }*/

            if($datos['report_attendend']==0 && !isset($_GET['report_stat'])){

                echo '
                    <div class="columns is-gapless">
                        <p class="column is-half"></p>
                        <p class="has-text-right pr-4 column is-one-quarter">
                            <a href="index.php?vista=report_detail&report_id_deta='.$id_det.'&report_stat" class="button is-danger is-rounded"><strong>Atender</strong></a>
                        </p>
                ';
                
                include "./inc/btn_volver.php";
    
                echo '</div>';
            }else{
                include "./inc/btn_volver.php";
            }
        }else{
            include "./inc/btn_volver.php";
        }
        

        $check_adm=null;

            include "./php/detalle_reportes.php";
    ?>
    <div class="table-container box">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr class="has-text-centered">
                    <th>Nombre del campo</th>
                    <th>Valor del campo</th>
                    <th>Acciones</th>
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
            include "./inc/btn_volver.php";
            include "./inc/notif_alerta.php";
        }
		$mostrar_report=null;
	?>


</div>