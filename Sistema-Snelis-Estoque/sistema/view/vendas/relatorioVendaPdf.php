<?php 
	require_once "../../classes/conexao.php";
	require_once "../../classes/vendas.php";

	$objv= new vendas();
	$c= new conectar();
	$conexao=$c->conexao();
	$idvenda=$_GET['idvenda'];

 	$sql="SELECT ve.id_venda,
		ve.dataCompra,
		ve.id_cliente,
		pro.nome,
        pro.preco,
        pro.descricao
	from vendas  as ve 
	inner join produtos as pro
	on ve.id_produto=pro.id_produto
	and ve.id_venda='$idvenda'";

$result=mysqli_query($conexao,$sql);

	$ver=mysqli_fetch_row($result);

	$comp=$ver[0];
	$data=$ver[1];
	$idcliente=$ver[2];
?>

<link rel="stylesheet" type="text/css" href="../../lib/bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../../css/style.css">

<img src="../../img/phpoo.png" width="200" height="120">
<br>
<h4 class="text-center">RELATÓRIO DE RETIRADA DE MATERIAIS</h4>
<br />
<table class="table">
	<tr>
		<td>DATA DA OPERAÇÃO: <?php echo date("d/m/Y", strtotime($data)); ?></td>
	</tr>
	<tr>
		<td>Nº DE CONTROLE: <?php echo $comp; ?></td>
	</tr>
	<tr>
		<td>RESPONSÁVEL PELA RETIRADA: <?php echo $objv->nomeCliente($idcliente); ?></td>
		<td>NÚCLEO: <?php //Saída de informação sobre o núcleo. ?></td>
	</tr>
</table>

<table class="table">
	<tr>
		<td>PRODUTO</td>
		<td>PREÇO</td>
		<td>QUANTIDADE</td>
		<td>DESCRIÇÃO</td>
	</tr>

	<?php 
	
	$sql="SELECT ve.id_venda,
			ve.dataCompra,
			ve.id_cliente,
			pro.nome,
	        pro.preco,
	        pro.descricao,
	        ve.quantidade,
	        ve.total_venda
		from vendas  as ve 
		inner join produtos as pro
		on ve.id_produto=pro.id_produto
		and ve.id_venda='$idvenda'";


$result=mysqli_query($conexao,$sql);

$total=0;
while($mostrar=mysqli_fetch_row($result)):
	 ?>

	<tr>
		<td><?php echo $mostrar[3]; ?></td>
		<td><?php echo "R$ ".$mostrar[4].",00"; ?></td>
		<td><?php echo $mostrar[6]; ?></td>
		<td><?php echo $mostrar[5]; ?></td>
	</tr>
	<?php 
		$total=$total + $mostrar[7];
	endwhile;
	 ?>
	 <tr>
	 	<td>Total: <?php echo "R$ ".$total.",00"; ?></td>
	 </tr>
</table>
<p></p>
<br />
Recebido por:
<p class="text-center"><?php echo $objv->nomeCliente($idcliente); ?></p>
<br />
<p class="text-center">____________________________________________________________</p>
<br />
<p><?php echo "Rio de Janeiro, " . date("d/m/Y", strtotime($data)."."); ?></p>