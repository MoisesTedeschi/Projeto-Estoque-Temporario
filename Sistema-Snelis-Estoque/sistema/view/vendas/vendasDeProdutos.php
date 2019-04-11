<?php 

require_once "../../classes/conexao.php";
	$c= new conectar();
	$conexao=$c->conexao();
?>

<br />
<h4><strong>NOVA SAÍDA</strong></h4>
<div class="row">
	<div class="col-sm-4">
		<form id="frmVendasProdutos">
			<label>Selecionar Cliente</label>

			<select class="form-control input-sm" id="clienteVenda" name="clienteVenda">
				<option value="A">Selecionar</option>
				<option value="0">Sem responsável</option>
				<?php
				$sql="SELECT id_cliente,nome,sobrenome,nucleo 
				from clientes";
				$result=mysqli_query($conexao,$sql);
				
				while ($cliente=mysqli_fetch_row($result)):
				?>
					<option value="<?php echo $cliente[0] ?>"><?php echo $cliente[1]." ".$cliente[2]; ?></option>
				
				<?php endwhile; ?>
			</select>

			<!--<p></p>
			<label>Núcleo</label>
			<input readonly="" type="text" class="form-control input-sm" id="nucleo" name="nucleo">-->

			<p></p>	

			<label>Produto</label>
			<select class="form-control input-sm" id="produtoVenda" name="produtoVenda">
				<option value="A">Selecionar</option>
				<?php
				$sql="SELECT id_produto,
				nome
				from produtos";
				$result=mysqli_query($conexao,$sql);

				while ($produto=mysqli_fetch_row($result)):
				?>
					<option value="<?php echo $produto[0] ?>"><?php echo $produto[1]; ?></option>
				<?php endwhile; ?>

			</select>
			<p></p>
			<label>Descrição</label>
			<textarea readonly="" id="descricaoV" name="descricaoV" class="form-control input-sm"></textarea>
			<br />
			<label>Quantidade Estoque</label>
			<input readonly="" type="text" class="form-control input-sm" id="quantidadeV" name="quantidadeV">
			<br />
			<label>Preço</label>
			<input readonly="" type="text" class="form-control input-sm" id="precoV" name="precoV">
			<br />
			<label>Quantidade para retirar</label>
			<input type="text" class="form-control input-sm" id="quantV" name="quantV">
			<br />
			<span class="btn btn-primary" id="btnAddVenda">Adicionar</span>
			<span class="btn btn-danger" id="btnLimparVendas">Limpar Saída</span>
		</form>
	</div>
	<div class="col-sm-3">
		<div id="imgProduto"></div>
	</div>
	<div class="col-sm-4">
		<div id="tabelaVendasTempLoad"></div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$('#tabelaVendasTempLoad').load("vendas/tabelaVendasTemp.php");

		$('#produtoVenda').change(function(){

			$.ajax({
				type:"POST",
				data:"idproduto=" + $('#produtoVenda').val(),
				url:"../procedimentos/vendas/obterDadosProdutos.php",
				success:function(r){
					dado=jQuery.parseJSON(r);

					$('#descricaoV').val(dado['descricao']);

					$('#quantidadeV').val(dado['quantidade']);
					$('#precoV').val(dado['preco']);
					
					//Anula a repetição das imagens na seleção.
					$( "#imgProduto" ).empty();
					$('#imgProduto').prepend('<img class="img-thumbnail" id="imgp" src="' + dado['url'] + '" />');
					
				}
			});
		});

		$('#btnAddVenda').click(function(){
			vazios=validarFormVazio('frmVendasProdutos');

			quant = 0;
			quantidade = 0;

			quant = $('#quantV').val();
			quantidade = $('#quantidadeV').val();



			if(parseInt(quant) > parseInt(quantidade)){
				alertify.alert("IMPORTANTE!", "Quantidade inexistente em estoque!!");
				quant = $('#quantV').val("");
				return false;
			}else{
				quantidade = $('#quantidadeV').val();
			}

			if(vazios > 0){
				alertify.alert("IMPORTANTE!", "Preencha os Campos!!");
				return false;
			}

			dados=$('#frmVendasProdutos').serialize();
			$.ajax({
				type:"POST",
				data:dados,
				url:"../procedimentos/vendas/adicionarProdutoTemp.php",
				success:function(r){
					$('#tabelaVendasTempLoad').load("vendas/tabelaVendasTemp.php");
				}
			});
		});

		$('#btnLimparVendas').click(function(){

		$.ajax({
			url:"../procedimentos/vendas/limparTemp.php",
			success:function(r){
				$('#tabelaVendasTempLoad').load("vendas/tabelaVendasTemp.php");
			}
		});
	});

	});
</script>

<script type="text/javascript">

	function editarP(dados){
		
		$.ajax({
			type:"POST",
			data:"dados=" + dados,
			url:"../procedimentos/vendas/editarEstoque.php",
			success:function(r){
				
				$('#tabelaVendasTempLoad').load("vendas/tabelaVendasTemp.php");
				alertify.success("Estoque atualizado com sucesso!!");
			}
		});
	}


	function fecharP(index){
		$.ajax({
			type:"POST",
			data:"ind=" + index,
			url:"../procedimentos/vendas/fecharProduto.php",
			success:function(r){
				$('#tabelaVendasTempLoad').load("vendas/tabelaVendasTemp.php");
				alertify.success("Produto removido com sucesso!!");
			}
		});
	}

	function criarVenda(){
		$.ajax({
			url:"../procedimentos/vendas/criarVenda.php",
			success:function(r){
				
				if(r > 0){
					$('#tabelaVendasTempLoad').load("vendas/tabelaVendasTemp.php");
					$('#frmVendasProdutos')[0].reset();
					alertify.alert("Saída criada com sucesso!");
				}else if(r==0){
					alertify.alert("Não possui lista de saída");
				}else{
					alertify.error("Processo de saída não efetuada!");
				}
			}
		});
	}
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#clienteVenda').select2();
		$('#produtoVenda').select2();

	});
</script>