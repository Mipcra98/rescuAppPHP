<?php
	require_once "./php/main.php";

	$id_det=isset($_GET['report_id_deta']) ? $_GET['report_id_deta'] : 0 ;
	$id_det=limpiar_cadena($id_det);

    //verificar datos del reporte para personalizar mensaje
    $check_report=conexion();
    $check_report=$check_report->query("SELECT report_id,report_dateTime FROM report WHERE report_id='".$id_det."'");
    $check_report=$check_report->fetch();

    include "./php/detalle_reportes.php";


?>
<div class="container is-fluid">
    <h2 class="subtitle">Detalle del Reporte de ID: <strong><?php echo $check_report['report_id'].'</strong>, en fecha: <strong>'.$check_report['report_dateTime']; ?></strong></h2>
</div>

<div class="container pr-6 pl-6 pb-6">
    
    <?php
        $campos="report.*,user.user_id,user.user_name,user.user_surname";
        include "./inc/btn_volver.php";
        $check_report=null;

		$mostrar_report=conexion();
		$mostrar_report=$mostrar_report->query("SELECT $campos FROM report INNER JOIN user ON report.report_userId=user.user_id WHERE report_id='$id_det'");

		if($mostrar_report->rowCount()>0){
			$datos=$mostrar_report->fetch();
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
                    detallar_reportes($id_det);
                ?>
            </tbody>
        </table>
    </div>
	
	<?php 
        }else{
            include "./inc/notif_alerta.php";
        }
		$mostrar_report=null;
	?>


</div>