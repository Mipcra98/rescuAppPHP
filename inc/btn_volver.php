    <p class="has-text-right pt-2 pb-4 pr-4 column">
		<a href="#" class="button is-rounded btn-back" style="background-color:#FF8000;border-color:#000000;"><strong><- Volver</strong></a>
	</p>
	<script type="text/javascript">
	    let btn_back = document.querySelector(".btn-back");

	    btn_back.addEventListener('click', function(e){
	        e.preventDefault();
	        window.history.back();
	    });
	</script>