<div id="nav">
  <div class="navbar navbar-inverse navbar-fixed-top" data-spy="affix">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Menu de Navegação</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="inicio.php"><img class="img-responsive logo img-thumbnail" src="../img/logo-projeto.png" alt="Logotipo do Projeto Esporte Cidadania" title="Projeto Esporte Cidadania - Governo Federal"></a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">

        <ul class="nav navbar-nav navbar-right">

          <li class="active"><a href="inicio.php"><span class="glyphicon glyphicon-home"></span> Início</a>
          </li>

          
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt"></span> Gestão Produtos <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="categorias.php">Categorias</a></li>
            <li><a href="produtos.php">Produtos</a></li>
          </ul>
        </li>
     
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Pessoas <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="responsavel.php">Responsáveis</a></li>
            <li><a href="fornecedores.php">Fornecedores</a></li>
          </ul>
        </li>
       
        <li><a href="saida.php"><span class="glyphicon glyphicon-inbox"></span> Gestão de Estoque</a>
        </li>
        
        <li class="dropdown" >
          <a href="#" style="color: red"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Usuário   <span class="caret"></span></a>
          <ul class="dropdown-menu">

          <?php if($_SESSION['usuario'] == "moisestedeschi@gmail.com"): ?>
            <li> <a href="usuarios.php"><span class="glyphicon glyphicon-off"></span> Gestão Usuários</a></li>
          <?php endif; ?>

            <li> <a style="color: red" href="../procedimentos/sair.php"><span class="glyphicon glyphicon-off"></span> Sair</a></li>
            
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>