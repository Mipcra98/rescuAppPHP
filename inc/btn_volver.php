<p class="has-text-right column is-1">
		<a href="#" class="button btn-back has-text-black-bis" style="background-color:#FF8000;border-color:#000000;">
			<strong><- Volver</strong>
		</a>
	</p>
	<script type="text/javascript">
	    let btn_back = document.querySelector(".btn-back");

	    btn_back.addEventListener('click', function(e){
	        e.preventDefault();
	        window.history.back();
	    });
	</script>