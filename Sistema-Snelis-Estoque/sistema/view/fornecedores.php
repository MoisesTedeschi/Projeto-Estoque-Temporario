<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<title>SGE - Sistema de Gestão de Estoque - Fornecedores</title>
	<?php require_once "dependencias.php"; ?>
</head>
<body>
<?php require_once "menu.php"; ?>
<div class="container-fluid">
	<div class="container">
		<h2>Fornecedores</h2>
		<div class="row">
			<div class="col-xs-12 col-md-4">
				<form id="frmFornecedores">
					<label>Nome</label>
					<input type="text" class="form-control input-sm" id="nome" name="nome">
					<br /> 
					<label>Sobrenome ou Nome Fantasia</label>
					<input type="text" class="form-control input-sm" id="sobrenome" name="sobrenome">
					<br />
					<label>Endereço</label>
					<input type="text" class="form-control input-sm" id="endereco" name="endereco">
					<br />
					<label>E-mail</label>
					<input type="text" class="form-control input-sm" id="email" name="email">
					<br />
					<label>Telefone</label>
					<input type="text" class="form-control input-sm" id="telefone" name="telefone">
					<br />
					<label>CPF ou CNPJ</label>
					<input type="text" class="form-control input-sm" id="cpf" name="cpf">
					<br />
					<span class="btn btn-primary" id="btnAdicionarFornecedores">Salvar</span>
				</form>
			</div>
			<div class="col-xs-12 col-md-8">
				<div id="tabelaFornecedoresLoad"></div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="abremodalFornecedoresUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Atualizar Fornecedor</h4>
			</div>
			<div class="modal-body">
				<form id="frmFornecedoresU">
					<input type="text" hidden="" id="idfornecedorU" name="idfornecedorU">
					<label>Nome</label>
					<input type="text" class="form-control input-sm" id="nomeU" name="nomeU">
					<br />
					<label>Sobrenome ou Nome Fantasia</label>
					<input type="text" class="form-control input-sm" id="sobrenomeU" name="sobrenomeU">
					<br />
					<label>Endereço</label>
					<input type="text" class="form-control input-sm" id="enderecoU" name="enderecoU">
					<br />
					<label>E-mail</label>
					<input type="text" class="form-control input-sm" id="emailU" name="emailU">
					<br />
					<label>Telefone</label>
					<input type="text" class="form-control input-sm" id="telefoneU" name="telefoneU">
					<br />
					<label>CPF ou CNPJ</label>
					<input type="text" class="form-control input-sm" id="cpfU" name="cpfU">
				</form>
			</div>
			<div class="modal-footer">
				<button id="btnAdicionarFornecedorU" type="button" class="btn btn-primary" data-dismiss="modal">Atualizar</button>

			</div>
		</div>
	</div>
</div>
<!-- Modal -->

<?php require_once "assinatura.php"; ?>

<script type="text/javascript">
	function adicionarDado(idfornecedor){

		$.ajax({
			type:"POST",
			data:"idfornecedor=" + idfornecedor,
			url:"../procedimentos/fornecedores/obterDadosFornecedores.php",
			success:function(r){



				dado=jQuery.parseJSON(r);


				$('#idfornecedorU').val(dado['id_fornecedor']);
				$('#nomeU').val(dado['nome']);
				$('#sobrenomeU').val(dado['sobrenome']);
				$('#enderecoU').val(dado['endereco']);
				$('#emailU').val(dado['email']);
				$('#telefoneU').val(dado['telefone']);
				$('#cpfU').val(dado['cpf']);



			}
		});
	}

	function eliminar(idfornecedor){
		alertify.confirm('Deseja Excluir este fornecedor?', function(){ 
			$.ajax({
				type:"POST",
				data:"idfornecedor=" + idfornecedor,
				url:"../procedimentos/fornecedores/eliminarFornecedores.php",
				success:function(r){



					if(r==1){
						$('#tabelaFornecedoresLoad').load("fornecedores/tabelaFornecedores.php");
						alertify.success("Excluido com sucesso!!");
					}else{
						alertify.error("Não foi possível excluir");
					}
				}
			});
		}, function(){ 
			alertify.error('Cancelado !')
		});
	}
</script>

<script type="text/javascript">
	$(document).ready(function(){

		$('#tabelaFornecedoresLoad').load("fornecedores/tabelaFornecedores.php");

		$('#btnAdicionarFornecedores').click(function(){

			vazios=validarFormVazio('frmFornecedores');

			if(vazios > 0){
				alertify.alert("Preencha os Campos!!");
				return false;
			}

			dados=$('#frmFornecedores').serialize();

			$.ajax({
				type:"POST",
				data:dados,
				url:"../procedimentos/fornecedores/adicionarFornecedores.php",
				success:function(r){

					if(r==1){
						$('#frmFornecedores')[0].reset();
						$('#tabelaFornecedoresLoad').load("fornecedores/tabelaFornecedores.php");
						alertify.success("Fornecedor Adicionado");
					}else{
						alertify.error("Não foi possível adicionar");
					}
				}
			});
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#btnAdicionarFornecedorU').click(function(){
			dados=$('#frmFornecedoresU').serialize();

			$.ajax({
				type:"POST",
				data:dados,
				url:"../procedimentos/fornecedores/atualizarFornecedores.php",
				success:function(r){

					
					if(r==1){
						$('#frmFornecedores')[0].reset();
						$('#tabelaFornecedoresLoad').load("fornecedores/tabelaFornecedores.php");
						alertify.success("Fornecedor atualizado com sucesso!");
					}else{
						alertify.error("Não foi possível atualizar fornecedor");
					}
				}
			});
		})
	})
</script>

<?php 
}else{
	header("location:../index.php");
}
?>

</body>
</html>