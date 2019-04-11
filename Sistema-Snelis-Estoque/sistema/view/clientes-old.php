<?php 
session_start();
if(isset($_SESSION['usuario'])){
?>
<!DOCTYPE html>
<html>
<head>
	<title>SGE - Sistema de Gestão de Estoque - Responsáveis</title>
	<?php require_once "dependencias.php"; ?>
</head>
<body>
	<?php require_once "menu.php"; ?>

	<div class="container">
		<h2>Responsável</h2>
		<div class="row">
			<div class="col-sm-4">
				<form id="frmClientes">
					<label>Nome</label>
					<input type="text" class="form-control input-sm" id="nome" name="nome">
					<br />
					<label>Sobrenome</label>
					<input type="text" class="form-control input-sm" id="sobrenome" name="sobrenome">
					<br />
					<label>Endereço</label>
					<input type="text" class="form-control input-sm" id="endereco" name="endereco">
					<br />
					<label>Email</label>
					<input type="text" class="form-control input-sm" id="email" name="email">
					<br />
					<label>Telefone</label>
					<input type="text" class="form-control input-sm" id="telefone" name="telefone">
					<br />
					<label>CPF</label>
					<input type="text" class="form-control input-sm" id="cpf" name="cpf">
					<br />
					<span class="btn btn-primary" id="btnAdicionarCliente">Salvar</span>
				</form>
			</div>
			<div class="col-sm-8">
				<div id="tabelaClientesLoad"></div>
			</div>
		</div>
	</div>

	<!-- Button trigger modal -->


	<!-- Modal -->
	<div class="modal fade" id="abremodalClientesUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Atualizar Responsável</h4>
				</div>
				<div class="modal-body">
					<form id="frmClientesU">
						<input type="text" hidden="" id="idclienteU" name="idclienteU">
						<label>Nome</label>
						<input type="text" class="form-control input-sm" id="nomeU" name="nomeU">
						<br />
						<label>Sobrenome</label>
						<input type="text" class="form-control input-sm" id="sobrenomeU" name="sobrenomeU">
						<br />
						<label>Endereço</label>
						<input type="text" class="form-control input-sm" id="enderecoU" name="enderecoU">
						<br />
						<label>Email</label>
						<input type="text" class="form-control input-sm" id="emailU" name="emailU">
						<br />
						<label>Telefone</label>
						<input type="text" class="form-control input-sm" id="telefoneU" name="telefoneU">
						<br />
						<label>CPF</label>
						<input type="text" class="form-control input-sm" id="cpfU" name="cpfU">
					</form>
				</div>
				<div class="modal-footer">
					<button id="btnAdicionarClienteU" type="button" class="btn btn-primary" data-dismiss="modal">Atualizar</button>

				</div>
			</div>
		</div>
	</div>

</body>
</html>
	
<script type="text/javascript">
	function adicionarDado(idcliente){

		$.ajax({
			type:"POST",
			data:"idcliente=" + idcliente,
			url:"../procedimentos/clientes/obterDadosCliente.php",
			success:function(r){

				dado=jQuery.parseJSON(r);


				$('#idclienteU').val(dado['id_cliente']);
				$('#nomeU').val(dado['nome']);
				$('#sobrenomeU').val(dado['sobrenome']);
				$('#enderecoU').val(dado['endereco']);
				$('#emailU').val(dado['email']);
				$('#telefoneU').val(dado['telefone']);
				$('#cpfU').val(dado['cpf']);



			}
		});
	}

	function eliminarCliente(idcliente){
		alertify.confirm('Excluir Responsável', 'Deseja Excluir este Responsável?', function(){ 
			$.ajax({
				type:"POST",
				data:"idcliente=" + idcliente,
				url:"../procedimentos/clientes/eliminarClientes.php",
				success:function(r){


					if(r==1){
						$('#tabelaClientesLoad').load("clientes/tabelaClientes.php");
						alertify.success("Excluido com sucesso!");
					}else{
						alertify.error("Não foi possível excluir!");
					}
				}
			});
		}, function(){ 
			alertify.error('Procedimento Cancelado!')
		});
	}
</script>

<script type="text/javascript">
	$(document).ready(function(){

		$('#tabelaClientesLoad').load("clientes/tabelaClientes.php");

		$('#btnAdicionarCliente').click(function(){

			vazios=validarFormVazio('frmClientes');

			if(vazios > 0){
				alertify.alert("IMPORTANTE", "Preencha Todos os Campos!");
				return false;
			}

			dados=$('#frmClientes').serialize();

			$.ajax({
				type:"POST",
				data:dados,
				url:"../procedimentos/clientes/adicionarClientes.php",
				success:function(r){

					if(r==1){
						$('#frmClientes')[0].reset();
						$('#tabelaClientesLoad').load("clientes/tabelaClientes.php");
						alertify.success("Responsável Adicionado!");
					}else{
						alertify.error("Não foi possível adicionar!");
					}
				}
			});
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#btnAdicionarClienteU').click(function(){
			dados=$('#frmClientesU').serialize();

			$.ajax({
				type:"POST",
				data:dados,
				url:"../procedimentos/clientes/atualizarClientes.php",
				success:function(r){



					if(r==1){
						$('#frmClientes')[0].reset();
						$('#tabelaClientesLoad').load("clientes/tabelaClientes.php");
						alertify.success("Responsável atualizado com sucesso!");
					}else{
						alertify.error("Não foi possível atualizar o responsável!");
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