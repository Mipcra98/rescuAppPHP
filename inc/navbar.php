<nav class="navbar pb-4 pt-4 pl-4 pr-4 has-background-grey" role="navigation" aria-label="main navigation">
  <div class="container is-widescreen">
    <div>
      <a class="navbar-brand" href="index.php?vista=home">
        <img src="./img/rescuApp-Logo.png" width="96" height="96">
        <strong class="navbar-item has-text-black-bis">RescuApp</strong>
      </a>

      <a role="button" class="navbar-burger has-text-black-bis" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>
    <div id="navbarBasicExample" class="navbar-menu columns is-vcentered">
      <div class="navbar-item has-dropdown is-hoverable column is-2">
        <a class="navbar-link has-text-black-bis">
          Otros detalles
        </a>
        <div class="navbar-dropdown has-background-grey">
          <a class="navbar-item has-text-black-bis" href="index.php?vista=user_list">Lista de Usuarios</a>
          <a class="navbar-item has-text-black-bis" href="index.php?vista=home">Lista de Reportes</a>
          <hr class="navbar-divider">
          <a class="navbar-item has-text-black-bis" href="index.php?vista=rescuer_list">Lista de Rescuers</a>
        </div>
      </div>
      <div class="navbar-item column">
        <p class="has-text-black-bis">¡Bienvenido <strong class="has-text-black-bis"><?php echo ucwords($_SESSION['nombre'])." ".ucwords($_SESSION['apellido']);?></strong>!</p>
      </div>

      <div class="navbar-item column">
        <div class="has-background-grey has-text-black-bis">La sesión expira en:<div id="temporizador" class="has-text-warning">5 minutos y 0 segundos</div></div>

        <script type="text/javascript">
          m = 4
          s = 59;
          var l = document.getElementById("temporizador");
          var id = window.setInterval(function(){
            document.onmousemove = function (){
              m = 4;
              s = 59;
            };
            if(m>0){
              l.innerText = m + " minutos y "+ s + " segundos";
            }else{
              l.innerText = s + " segundos";
            }
            if(s==0 && m>0){
              s=59;
              --m;
            }
            
            --s;

            if (s <= -1){
              location.href="index.php?vista=logout";
              alert("La sesión expiró");
            }
            
          },1200);
        </script>

      </div>

      <div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons">
            <a href="index.php?vista=DwlRescueAppAPK" class="button is-normal has-text-black-bis has-background-danger-dark" style="border-color:#000000;">
              <strong>Descargar APK</strong>
            </a>
            <?php 
              if(isset($_SESSION['id'])){
                echo '
                <a href="index.php?vista=rescuer_update&rescuer_id_up='.$_SESSION['id'].'" class="button is-normal has-text-black-bis" style="background-color:#FF8000;border-color:#000000;">
                  <strong>Configuración</strong>
                </a>
                ';
              }
            ?>
            <a href="index.php?vista=logout" class="button has-text-black-bis is-normal has-background-grey-light" style="border-color:#000000;">
            <strong>Desconectarse</strong>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>