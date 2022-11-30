<div class="container is-fluid">
    <h1 class="title">Rescuers</h1>
    <h2 class="subtitle">Lista de Rescuers</h2>
</div>

<div class="container pr-6 pl-6">

    <?php 
        require_once "./php/main.php";
        
        $busqueda="";

        if(isset($_GET['rescuer_id_del'])){
            require_once "./php/borrar_rescuer.php";
        }

        require_once "./php/listar_rescuers.php";
        
		include "./inc/btn_volver.php";
    ?>

    <div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr class="has-text-centered">
                    <th>#</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Dependencia</th>
                    <?php 
                        if($_SESSION['ademin']=='1'){
                            echo '<th colspan="2">Acciones</th>';
                        }else{
                            echo '<th colspan="1">Acciones</th>';
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                    listar_rescuers();
                ?>
                <tr class="has-text-centered" >
                    <td colspan="7">
                        <a href="index.php?vista=rescuer_list" class="button is-info is-rounded is-small mt-4 mb-4">
                            Haga clic acá para recargar el listado
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>


</div>