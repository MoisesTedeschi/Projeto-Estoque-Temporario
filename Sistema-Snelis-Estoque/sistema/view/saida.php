<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<title>SGE - Sistema de Gestão de Estoque - Gestão de Estoque</title>
	<?php require_once "dependencias.php"; ?>
</head>
<body>
<?php require_once "menu.php"; ?>
<div class="container-fluid">
	<div class="container">
		 <h2>Gestão de Estoque</h2>
		 <div class="row">
		 	<div class="col-xs-12 col-md-4">
		 		<span class="btn btn-default" id="vendaProdutosBtn">Saída de Produto</span>
		 		<span class="btn btn-default" id="vendasFeitasBtn">Listar de Produtos</span>
		 	</div>
		 </div>
		 <div class="row">
		 	<div class="col-sm-12">
		 		<div id="vendaProdutos"></div>
		 		<div id="vendasFeitas">
		 			
				<?php 
				//require_once "vendas/vendasRelatorios.php" 
				?>

		 		</div>
		 	</div>
		 </div>
	</div>
</div>

<?php require_once "assinatura.php"; ?>

<script type="text/javascript">
	$(document).ready(function(){
		$('#vendaProdutosBtn').click(function(){
			esconderSessaoVenda();
			$('#vendaProdutos').load('vendas/vendasDeProdutos.php');
			$('#vendaProdutos').show();
		});
		$('#vendasFeitasBtn').click(function(){
			esconderSessaoVenda();
			$('#vendasFeitas').load('vendas/vendasRelatorios.php');
			$('#vendasFeitas').show();
		});
	});

	function esconderSessaoVenda(){
		$('#vendaProdutos').hide();
		$('#vendasFeitas').hide();
	}

</script>

<?php 
	}else{
		header("location:../index.php");
	}
?>

</body>
</html>