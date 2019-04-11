<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<title>SGE - Sistema de Gestão de Estoque - Início</title>
	<?php require_once "dependencias.php"; ?>
</head>
<body>
	<?php require_once "menu.php" ?>

	<div id="vendasFeitas"></div>

	<?php require_once "assinatura.php"; ?>

	<script type="text/javascript">
	$(document).ready(function(){
	  $('#vendasFeitas').load('vendas/vendasRelatorios.php'); 
	  $('#vendasFeitas').show();
	    
	});
	</script>

	<?php 
	} else{
	  header("location:../index.php");
	}
	?>
</body>
</html>