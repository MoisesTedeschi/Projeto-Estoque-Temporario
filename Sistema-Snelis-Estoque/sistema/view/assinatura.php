<footer>
	<div class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-4">
					© <?php echo date('Y'); ?> - Desenvolvido por <strong><a href="https://www.themoa.me" target="_blank" title="Desenvolvido por Moisés Tedeschi - Coordenador de Área - Esporte e Cidadania">MOA Creative</a></strong>
				</div>
			</div>
		</div>
	</div>

	<?php //Efeito de Logotipo suave ?>
	<script type="text/javascript">
	  $(window).scroll(function() {
	    if ($(document).scrollTop() > 2) {
	      	$('.logo').width(100);
	     	$('.logo').height(60);
	    }
	    else {
	    	$('.logo').width(200);
	      	$('.logo').height(110);
	    }
	  }
	  );
	</script>
	<?php //Efeito de Logotipo suave ?>

</footer>