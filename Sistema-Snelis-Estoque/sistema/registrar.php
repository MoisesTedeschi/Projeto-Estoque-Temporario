<?php
	require_once "classes/conexao.php";
	$obj = new conectar();
	$conexao = $obj->conexao();

	$sql = "SELECT * from usuarios where email='moisestedeschi@gmail.com'";
	$result = mysqli_query($conexao, $sql);

	$validar = 0;
	if(mysqli_num_rows($result) > 0){
		header("location:index.php");
	}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<title>SGE - Sistema de Gestão de Estoque - Registrar Usuário</title>
	<link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
	<script src="lib/jquery-3.2.1.min.js"></script>
	<script src="js/funcoes.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="moa_acesso">
<div class="container-fluid">
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4 moa_acesso_painel">
				<div class="panel panel-primary">
					<div class="panel panel-heading moa_acesso_painel_init">Registro de Usuário</div>
					<div class="panel panel-body moa_acesso_painel_init_logo">

						<p>
							<a href="index.php"><img src="img/logo-projeto.png" alt="Logotipo do Projeto Esporte Cidadania" title="Projeto Esporte Cidadania - Governo Federal"></a>
						</p>

						<form id="frmRegistro">
							<label>Nome Completo*</label>
							<input type="text" class="form-control input-sm" name="nome" id="nome" placeholder="Insira seu nome completo">
							<br />
							<label>Usuário*</label>
							<input type="text" class="form-control input-sm" name="usuario" id="usuario" placeholder="Insira o nome de usuário">
							<br />
							<label>Email*</label>
							<input type="text" class="form-control input-sm" name="email" id="email" placeholder="Insira um email válido">
							<br />
							<label>Senha*</label>
							<input type="password" class="form-control input-sm" name="senha" id="senha" placeholder="Insira uma senha">
							<br />
							<span class="btn btn-primary" id="registro">Registrar</span>
							<a href="index.php" class="btn btn-default">Voltar Login</a>
						</form>
						<br />
						<p>Todos os campos com (*) são obrigatórios!</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#registro').click(function(){

			vazios=validarFormVazio('frmRegistro');

			if(vazios > 0){
				alert("Preencha os Campos!");
				return false;
			}

			dados=$('#frmRegistro').serialize();
			
			$.ajax({
				type:"POST",
				data:dados,
				url:"procedimentos/login/registrarUsuario.php",
				success:function(r){
					//alert(r);

					if(r==1){
						alert("Inserido com Sucesso!");
						window.location.href = "index.php";
					}else{
						alert("Erro ao Inserir!");
					}
				}
			});
		});
	});
</script>

</body>
</html>