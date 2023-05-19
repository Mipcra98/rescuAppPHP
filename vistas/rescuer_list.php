

<div class="container pr-6 pl-6 pb-6 pt-4 has-text-black-bis">
<div class="container columns is-vcentered pl-4 pr-6">
    <div class="column is-one-quarter">
        <h1 class="title has-text-black-bis">Rescuers</h1>
        <h2 class="subtitle has-text-black-bis">Lista de Rescuers</h2>
    </div>
    <?php 
        require_once "./php/main.php";
        
        $busqueda="";
        echo '<div class="column">';
        if(isset($_GET['rescuer_id_del'])){
            require_once "./php/borrar_rescuer.php";
        }
        echo '</div>';
        require_once "./php/listar_rescuers.php";
        
        include "./inc/btn_volver.php";
    ?>
</div>

    <div class="table-container box has-text-black-bis has-background-grey-lighter">
        <table class="table is-striped is-hoverable is-fullwidth is-bordered has-background-grey-lighter">
            <thead>
                <tr class="has-background-grey-light">
                    <th class="has-text-centered" >ID</th>
                    <th class="has-text-centered" >Nombres</th>
                    <th class="has-text-centered" >Apellidos</th>
                    <th class="has-text-centered" >Teléfono</th>
                    <th class="has-text-centered" >Dependencia</th>
                    <th colspan="1" class="has-text-centered" >Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    listar_rescuers();
                ?>
                <tr class="has-text-centered" >
                    <td colspan="6">
                        <a href="index.php?vista=rescuer_list" class="button has-background-info-dark mt-2 mb-2 ml-2 mr-2 columns is-mobile is-centered is-normal has-text-white-bis">
                            Haga clic acá para recargar el listado
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

</div>