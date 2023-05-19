

<div class="container pr-6 pl-6 pb-6 pt-4 has-text-black-bis">
<div class="container pb-4 is-vcentered pr-5 pl-5">
    <h1 class="title has-text-black-bis">Página Principal</h1>
    <h2 class="subtitle has-text-black-bis">Lista de Reportes</h2>
</div>
    <?php 
        require_once "./php/main.php";

        require_once "./php/listar_reportes.php";
    ?>

    <div class="table-container box has-text-black-bis has-background-grey-lighter">
        <table class="table is-striped is-hoverable is-fullwidth is-bordered has-background-grey-lighter">
            <thead>
                <tr class="has-background-grey-light">
                    <th class="has-text-centered" >ID</th>
                    <th class="has-text-centered" >Fecha y Hora</th>
                    <th class="has-text-centered" >Tipo</th>
                    <th class="has-text-centered" >Información</th>
                    <th class="has-text-centered" >Estado</th>
                    <th class="has-text-centered" >Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    listar_reportes();
                ?>
                <tr class="has-text-centered">
                    <td colspan="6">
                        <a href="index.php" class="button has-background-info-dark mt-2 mb-2 ml-2 mr-2 columns is-mobile is-centered is-normal has-text-white-bis">
                            <strong>Haga clic acá para recargar el listado</strong>
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

</div>