<?php 
	session_start();
?>
 <h4>
 	<strong>
 		Detalhes da Saída
 	</strong>
 </h4>
 <h4>	
 	<div id="nomeclienteVenda"></div>
 </h4>

 <table class="table table-bordered table-hover table-condensed text-center">
 	<tr>
 		<td>Nome</td>
 		<td>Descrição</td>
 		<td>Preço</td>
 		<td>Quantidade</td>
 		<td>Remover</td>
 	</tr>
 	<?php 
 	$total=0;//total da venda em dinheiro
 	$cliente=""; //nome cliente
 		if(isset($_SESSION['tabelaComprasTemp'])):
 			$i=0;
 			foreach (@$_SESSION['tabelaComprasTemp'] as $key) {

 				$d=explode("||", @$key);
 	 ?>

 	<tr>
 		<td><?php echo $d[1] ?></td>
 		<td><?php echo $d[2] ?></td>
 		<td><?php echo "R$ ".$d[3].",00" ?></td>
 		<td><?php echo $d[6]; ?></td>
 		<td>

 			<span class="btn btn-danger btn-xs" onclick="fecharP('<?php echo $i; ?>'), editarP('<?php echo $d[0]; ?>, <?php echo $d[5]; ?>')">
 				<span class="glyphicon glyphicon-remove"></span>
 			</span>
 		</td>
 	</tr>

 <?php 
 		$calc = $d[3] * $d[6];
 		$total=$total + $calc;
 		$i++;
 		$cliente=$d[4];
 	}
 	endif; 
 ?>

 	<tr>
 		<td>Valor Total dos Produtos: <?php echo "R$ ".$total.",00"; ?></td>
 	</tr>

 	<!--
 	<caption>
 		<span class="btn btn-success" onclick="criarVenda()"> Nova Saída
 			<span class="glyphicon glyphicon-list-alt"></span>
 		</span>
 	</caption>
	-->
</table>

<span class="btn btn-success" onclick="criarVenda()" title="Adicionar Nova Saída"> Nova Saída
	<span class="glyphicon glyphicon-list-alt"></span>
</span>

<script type="text/javascript">
	$(document).ready(function(){
		nome="<?php echo @$cliente ?>";
		$('#nomeclienteVenda').text("Responsável pela retirada: " + nome);
	});
</script>