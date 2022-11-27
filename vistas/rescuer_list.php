<div class="container is-fluid mb-6">
    <h1 class="title">Rescuers</h1>
    <h2 class="subtitle">Lista de Rescuers</h2>
</div>

<div class="container pb-6 pt-6">

    <?php 
        require_once "./php/main.php";
        
        $busqueda="";

        require_once "./php/listar_rescuers.php";
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
                    <th colspan="2">Acciones</th>
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