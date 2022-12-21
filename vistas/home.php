

<div class="container pr-6 pl-6 pb-6">
<div class="container is-fluid pb-4">
    <h1 class="title">Página Principal</h1>
    <h2 class="subtitle">Lista de Reportes</h2>
</div>
    <?php 
        require_once "./php/main.php";

        require_once "./php/listar_reportes.php";
    ?>

    <div class="table-container box">
        <table class="table is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr class="has-text-centered">
                    <th>ID</th>
                    <th>Fecha y Hora</th>
                    <th>Tipo</th>
                    <th>Información</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    listar_reportes();
                ?>
                <tr class="has-text-centered" >
                    <td colspan="6">
                        <a href="index.php" class="button is-info is-rounded is-small mt-4 mb-4">
                            Haga clic acá para recargar el listado
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

</div>