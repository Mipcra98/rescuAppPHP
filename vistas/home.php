

<div class="container pr-6 pl-6 pb-6 pt-4 has-text-black-bis">
<div class="container pb-4 is-vcentered pr-5 pl-5">
    <h1 class="title has-text-black-bis">Lista de Reportes</h1>
    <h2 class="subtitle has-text-black-bis" id="tiempo_recarga">Actualizando en 15 segundos</h2>
</div>
    <?php 
        require_once "./php/main.php";
    ?>

    <div class="table-container box has-text-black-bis has-background-grey-lighter" id="recarga_lista">
        
    </div>
    
    <script type="text/javascript">
        window.onload = listar();
                    function listar(){
                        $('#recarga_lista').load('./php/listar_reportes.php');
                    }
                    temp = 14;
                    var lis = document.getElementById("tiempo_recarga");
                    $(document).ready(function(){
                        setInterval(
                            function(){
                                lis.innerText = "Actualizando en "+temp+" segundos";
                                if (temp <= 0){
                                    temp = 16;
                                    listar();
                                }
                                --temp;
                            },1000
                        );
                    });
                </script>
</div>