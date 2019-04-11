<?php session_start(); ?>
<?php 
require_once "../../classes/conexao.php";
	$c = new conectar();
		$conexao=$c->conexao();

	$sql = "SELECT id_cliente, nome, sobrenome, nucleo, endereco, email, telefone, cpf FROM clientes";
	$result = mysqli_query($conexao, $sql);
?>
<table class="table table-hover table-condensed table-bordered text-center">
	<caption><label>Listar Responsáveis</label></caption>
	<tr>
			<td class="text-left">Nome</td>
	 		<td class="text-left">Sobrenome</td>
	 		<td class="text-left">Núcleo</td>
	 		<td class="text-left">Endereço</td>
	 		<td>Email</td>
	 		<td>Telefone</td>
	 		<td>CPF</td>
		<?php if($_SESSION['usuario'] == "moisestedeschi@gmail.com"): ?>
	 		<td>Editar</td>
			<td>Excluir</td>
		<?php endif; ?>
	</tr>

	<?php while($mostrar = mysqli_fetch_row($result)): ?>

	<tr>
		<td class="text-left"><?php echo $mostrar[1]; ?></td>
		<td class="text-left"><?php echo $mostrar[2]; ?></td>
		<td class="text-left"><?php echo $mostrar[3]; ?></td>
		<td><?php echo $mostrar[4]; ?></td>
		<td><?php echo $mostrar[5]; ?></td>
		<td><?php echo $mostrar[6]; ?></td>
		<td><?php echo $mostrar[7]; ?></td>
		<?php if($_SESSION['usuario'] == "moisestedeschi@gmail.com"): ?>
			<td>
				<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalClientesUpdate" onclick="adicionarDado('<?php echo $mostrar[0]; ?>')">
					<span class="glyphicon glyphicon-pencil"></span>
				</span>
			</td>
			<td>
				<span class="btn btn-danger btn-xs" onclick="eliminarCliente('<?php echo $mostrar[0]; ?>')">
					<span class="glyphicon glyphicon-remove"></span>
				</span>
			</td>
		<?php endif; ?>
	</tr>


<?php endWhile; ?>
</table>