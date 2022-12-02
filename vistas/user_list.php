<div class="container is-fluid">
    <h1 class="title">Usuarios</h1>
    <h2 class="subtitle">Lista de Usuarios</h2>
</div>

<div class="container pr-6 pl-6">

    <?php 
        require_once "./php/main.php";
        
        $busqueda="";
          
		include "./inc/btn_volver.php";

        require_once "./php/listar_users.php";
    ?>

    <div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr class="has-text-centered">
                    <th>#</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th colspan="1">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    listar_users();
                ?>
                <tr class="has-text-centered" >
                    <td colspan="6">
                        <a href="index.php?vista=rescuer_list" class="button is-info is-rounded is-small mt-4 mb-4">
                            Haga clic acá para recargar el listado
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

</div>