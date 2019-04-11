<?php
	require_once "classes/conexao.php";
	$obj = new conectar();
	$conexao = $obj->conexao();

	$sql = "SELECT * from usuarios where email='moisestedeschi@gmail.com'";
	$result = mysqli_query($conexao, $sql);

	$validar = 0;
	if(mysqli_num_rows($result) > 0){
		$validar = 1;
	}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<title>SGE - Sistema de Gestão de Estoque</title>
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
					<div class="panel panel-heading moa_acesso_painel_init"><h4 class="text-center">SGE - Sistema de Gestão de Estoque</h4></div>
					<div class="panel panel-body moa_acesso_painel_init_logo">
						<p>
							<a href="index.php"><img src="img/logo-projeto.png" alt="Logotipo do Projeto Esporte Cidadania" title="Projeto Esporte Cidadania - Governo Federal"></a>
						</p>

						<form id="frmLogin">
							<label>Email</label>
							<input type="text" class="form-control input-sm" name="email" id="email" placeholder="Insira seu email">
							<br />
							<label>Senha</label>
							<input type="password" name="senha" id="senha" class="form-control input-sm" placeholder="Insira sua senha">
							<br />
							<span class="btn btn-primary btn-sm" id="entrarSistema">Entrar</span>
							
							<?php if(!$validar): ?>
								<a href="registrar.php" class="btn btn-danger btn-sm">Registrar</a>
							<?php 
								endif;
							?>	
						</form>
					</div>
				</div>
				<p class="text-center moa_acesso_dev_moa">Desenvolvido por <strong><a href="https://www.themoa.me" target="_blank" title="Desenvolvido por Moisés Tedeschi - Coordenador de Área - Esporte e Cidadania">MOA Creative</a></strong></p>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#entrarSistema').click(function(){

	vazios=validarFormVazio('frmLogin');

		if(vazios > 0){
			alert("Preencha os campos!");
			return false;
		}

	dados=$('#frmLogin').serialize();
	$.ajax({
		type:"POST",
		data:dados,
		url:"procedimentos/login/login.php",
		success:function(r){
			//alert(r);
			if(r==1){
				window.location="view/inicio.php";
			}else{
				alert("ACESSO NEGADO!");
			}
		}
	});
});
});
</script>

</body>
</html>