<?php 

class clientes{
	public function adicionarCliente($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		

		$sql = "INSERT into clientes (id_usuario, nome, sobrenome, nucleo, endereco, email, telefone, cpf) VALUES ('$dados[0]', 
			'$dados[1]', 
		   	'$dados[2]',
		   	'$dados[3]',
			'$dados[4]',
			'$dados[5]',
			'$dados[6]',
			'$dados[7]')";



		return mysqli_query($conexao, $sql);
	}




	public function obterDadosCliente($idcliente){
		$c = new conectar();
		$conexao=$c->conexao();

		$sql = "SELECT id_cliente, nome, sobrenome, nucleo, endereco, email, telefone, cpf from clientes where id_cliente='$idcliente' ";

			$result = mysqli_query($conexao, $sql);
			$mostrar = mysqli_fetch_row($result);


			$dados = array(
				'id_cliente' => $mostrar[0],
				'nome' 		 => $mostrar[1],
				'sobrenome'  => $mostrar[2],
				'nucleo' 	 => $mostrar[3],
				'endereco' 	 => $mostrar[4],
				'email'		 => $mostrar[5],
				'telefone'	 => $mostrar[6],
				'cpf'		 => $mostrar[7],
			);

			return $dados;

	}


	public function atualizarCliente($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		

		$sql = "UPDATE clientes SET nome = '$dados[1]', sobrenome = '$dados[2]', nucleo = '$dados[3]',endereco = '$dados[4]',email = '$dados[5]',telefone = '$dados[6]',cpf = '$dados[7]' where id_cliente = '$dados[0]'";


		echo mysqli_query($conexao, $sql);
	}


	public function excluirCliente($id){
		$c = new conectar();
		$conexao=$c->conexao();
		

		$sql = "DELETE from clientes where id_cliente = '$id' ";

		return mysqli_query($conexao, $sql);
	}

}

?>