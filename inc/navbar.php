<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <img src="./img/rescuApp-Logo.png" width="96" height="96">
    <a class="navbar-item" href="index.php?vista=principal">
      <strong>RescuApp</strong>
    </a>

    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>
  <div id="navbarBasicExample" class="navbar-menu">
  <?php
  if ($_SESSION['ademin']=='1'){
    echo '
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          Admin
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="index.php?vista=user_list">Lista de Usuarios</a>
          <a class="navbar-item" href="index.php?vista=user_search">Buscar Usuario</a>
          <a class="navbar-item" href="index.php?vista=report_update">Actualizar Reporte</a>
          <hr class="navbar-divider">
          <a class="navbar-item" href="index.php?vista=rescuer_new">Nuevo Rescuer</a>
          <a class="navbar-item" href="index.php?vista=rescuer_list">Lista de Rescuer</a>
          <a class="navbar-item" href="index.php?vista=rescuer_search">Buscar Rescuer</a>
          <a class="navbar-item" href="index.php?vista=rescuer_update">Actualizar Rescuer</a>
        </div>
      </div>
    ';
    }
    ?>
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <?php 
            if(isset($_SESSION['id'])){
              echo '
              <a href="index.php?vista=rescuer_update&rescuer_id_up='.$_SESSION['id'].'" class="button is-warning is-rounded">
                <strong>Configuración</strong>
              </a>
              ';
            }
          ?>
          <a href="index.php?vista=logout" class="button is-light is-rounded">
            Desconectarse
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>