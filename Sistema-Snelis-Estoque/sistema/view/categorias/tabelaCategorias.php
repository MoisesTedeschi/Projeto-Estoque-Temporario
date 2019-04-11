<?php session_start(); ?>
<?php 
require_once "../../classes/conexao.php";
	$c = new conectar();
		$conexao=$c->conexao();
	$sql = "SELECT id_categoria, nome_categoria FROM categorias";
	$result = mysqli_query($conexao, $sql);
?>
<table class="table table-hover table-condensed table-bordered text-center">
	<caption><label>Lista de Categorias</label></caption>
	<tr>
		<td class="text-left">Categoria</td>
		<?php if($_SESSION['usuario'] == "moisestedeschi@gmail.com"): ?>
			<td>Editar</td>
			<td>Excluir</td>
		<?php endif; ?>
	</tr>

	<?php while($mostrar = mysqli_fetch_row($result)): ?>

	<tr>
		<?php if($_SESSION['usuario'] == "moisestedeschi@gmail.com"): ?>
			<td class="text-left"><?php echo $mostrar[1]; ?></td>
			<td>
				<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#atualizaCategoria" onclick="adicionarDado('<?php echo $mostrar[0]; ?>','<?php echo $mostrar[1]; ?>')">
					<span class="glyphicon glyphicon-pencil"></span>
				</span>
			</td>
			<td>
				<span class="btn btn-danger btn-xs" onclick="eliminaCategoria('<?php echo $mostrar[0]; ?>')">
					<span class="glyphicon glyphicon-remove"></span>
				</span>
			</td>
		<?php endif; ?>
	</tr>
<?php endWhile; ?>
</table>