<?php session_start(); ?>
<?php 
	require_once "../../classes/conexao.php";
	$c= new conectar();
	$conexao=$c->conexao();

	$sql="SELECT id,
				nome,
				user,
				email
			from usuarios";
	$result=mysqli_query($conexao, $sql);
?>
<table class="table table-hover table-condensed table-bordered text-center">
	<caption><label>Listar Usuários</label></caption>
	<tr>
		<td class="text-left">Nome</td>
		<td>Usuário</td>
		<td>Email</td>
		<?php if($_SESSION['usuario'] == "moisestedeschi@gmail.com"): ?>
			<td>Editar</td>
			<td>Excluir</td>
		<?php endif; ?>
	</tr>

	<?php while($mostrar = mysqli_fetch_row($result)): ?>

	<tr>
		<td class="text-left"><?php echo $mostrar[1]; ?></td>
		<td><?php echo $mostrar[2]; ?></td>
		<td><?php echo $mostrar[3]; ?></td>
		<?php if($_SESSION['usuario'] == "moisestedeschi@gmail.com"): ?>
			<td>
				<span data-toggle="modal" data-target="#atualizaUsuarioModal" class="btn btn-warning btn-xs" onclick="adicionarDados('<?php echo $mostrar[0]; ?>')">
					<span class="glyphicon glyphicon-pencil"></span>
				</span>
			</td>
			<td>
				<span class="btn btn-danger btn-xs" onclick="eliminarUsuario('<?php echo $mostrar[0]; ?>')">
					<span class="glyphicon glyphicon-remove"></span>
				</span>
			</td>
		<?php endif; ?>
	</tr>

<?php endwhile; ?>
</table>