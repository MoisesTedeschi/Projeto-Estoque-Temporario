<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<title>SGE - Sistema de Gestão de Estoque - Usuários do Sistema</title>
	<?php require_once "dependencias.php"; ?>

</head>
<body>
<?php require_once "menu.php"; ?>
<div class="container-fluid">
	<div class="container">
		<h2>Administrar Usuários</h2>
		<div class="row">
			<div class="col-xs-12 col-md-4">
				<form id="frmRegistro">
					<label>Nome</label>
					<input type="text" class="form-control input-sm" name="nome" id="nome">
					<br />
					<label>Usuário</label>
					<input type="text" class="form-control input-sm" name="usuario" id="usuario">
					<br />
					<label>Email</label>
					<input type="text" class="form-control input-sm" name="email" id="email">
					<br />
					<label>Senha</label>
					<input type="text" class="form-control input-sm" name="senha" id="senha">
					<br />
					<span class="btn btn-primary" id="registro">Salvar</span>

				</form>
			</div>
			<div class="col-xs-12 col-md-8">
				<div id="tabelaUsuariosLoad"></div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="atualizaUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Editar Usuário</h4>
			</div>
			<div class="modal-body">
				<form id="frmRegistroU">
					<input type="text" hidden="" id="idUsuario" name="idUsuario">
					<label>Nome</label>
					<input type="text" class="form-control input-sm" name="nomeU" id="nomeU">
					<br />
					<label>Usuário</label>
					<input type="text" class="form-control input-sm" name="usuarioU" id="usuarioU">
					<br />
					<label>Email</label>
					<input type="text" class="form-control input-sm" name="emailU" id="emailU">

				</form>
			</div>
			<div class="modal-footer">
				<button id="btnAtualizaUsuario" type="button" class="btn btn-warning" data-dismiss="modal">Editar</button>

			</div>
		</div>
	</div>
</div>
<!-- Modal -->

<?php require_once "assinatura.php"; ?>

<script type="text/javascript">
	function adicionarDados(idusuario){

		$.ajax({
			type:"POST",
			data:"idusuario=" + idusuario,
			url:"../procedimentos/usuarios/obterDados.php",
			success:function(r){

				dado=jQuery.parseJSON(r);

				$('#idUsuario').val(dado['id']);
				$('#nomeU').val(dado['nome']);
				$('#usuarioU').val(dado['user']);
				$('#emailU').val(dado['email']);
			}
		});
	}

	function eliminarUsuario(idusuario){
		alertify.confirm('IMPORTANTE!', 'Deseja excluir este usuario?', function(){ 
			$.ajax({
				type:"POST",
				data:"idusuario=" + idusuario,
				url:"../procedimentos/usuarios/eliminarUsuario.php",
				success:function(r){
					if(r==1){
						$('#tabelaUsuariosLoad').load('usuarios/tabelaUsuarios.php');
						alertify.success("Usuário excluido com sucesso!");
					}else{
						alertify.error("Usuário não excluido!");
					}
				}
			});
		}, function(){ 
			alertify.error('Processo cancelado!')
		});
	}


</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#btnAtualizaUsuario').click(function(){

			datos=$('#frmRegistroU').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procedimentos/usuarios/atualizarUsuario.php",
				success:function(r){

					

					if(r==1){
						$('#tabelaUsuariosLoad').load('usuarios/tabelaUsuarios.php');
						alertify.success("Usuário editado com sucesso!");
					}else{
						alertify.error("Não foi possível editar o usuário!");
					}
				}
			});
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){

		$('#tabelaUsuariosLoad').load('usuarios/tabelaUsuarios.php');

		$('#registro').click(function(){

			vazios=validarFormVazio('frmRegistro');

			if(vazios > 0){
				alertify.alert("IMPORTANTE!", "Preencha os campos!!");
				return false;
			}

			datos=$('#frmRegistro').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procedimentos/login/registrarUsuario.php",
				success:function(r){
					//alert(r);

					if(r==1){
						$('#frmRegistro')[0].reset();
						$('#tabelaUsuariosLoad').load('usuarios/tabelaUsuarios.php');
						alertify.success("Adicionado com sucesso");
					}else{
						alertify.error("Falha ao adicionar :(");
					}
				}
			});
		});
	});
</script>

<?php
}else{
	header("location:../index.php");
}
?>

</body>
</html>