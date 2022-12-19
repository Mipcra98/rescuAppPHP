<nav class="navbar pb-4 pt-4 pl-4 pr-4" role="navigation" aria-label="main navigation">
  <div>
    <a class="navbar-brand" href="index.php?vista=home">
      <img src="./img/rescuApp-Logo.png" width="96" height="96">
      <strong class="navbar-item">RescuApp</strong>
    </a>

    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>
  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-item has-dropdown is-hoverable">
      <a class="navbar-link">
        Otros detalles
      </a>
      <div class="navbar-dropdown">
        <a class="navbar-item" href="index.php?vista=user_list">Lista de Usuarios</a>
        <a class="navbar-item" href="index.php?vista=home">Lista de Reportes</a>
        <hr class="navbar-divider">
        <a class="navbar-item" href="index.php?vista=rescuer_list">Lista de Rescuers</a>
      </div>
    </div>
    <div class="navbar-item">
      <p>¡Bienvenido <strong><?php echo ucwords($_SESSION['nombre'])." ".ucwords($_SESSION['apellido']);?></strong>!</p>
    </div>
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <?php 
            if(isset($_SESSION['id'])){
              echo '
              <a href="index.php?vista=rescuer_update&rescuer_id_up='.$_SESSION['id'].'" class="button is-rounded" style="background-color:#FF8000;border-color:#000000;">
                <strong>Configuración</strong>
              </a>
              ';
            }
          ?>
          <a href="index.php?vista=logout" class="button is-light is-rounded" style="border-color:#000000;">
          <strong>Desconectarse</strong>
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>