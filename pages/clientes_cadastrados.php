<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Gestão de Eventos">
    <meta name="author" content="Quarto Periodo SI">

    <title>Cadastro de Clientes</title>
     <link rel="stylesheet" href="../styles/root.css">
     <link rel="stylesheet" href="../styles/index.css">
     <link rel="stylesheet" href="../styles/navbar.css">
      <link rel="stylesheet" href="../styles/lista.css">

  </head>
  <body>
    <?php
      require_once(__DIR__ . '/../conecta.php');
      ?>
    <div class="navbar"> 
      <a href="../index.html">Inicio</a> 
      <a href="novo_pedido.php">Novo Pedido</a> 
      <a href="todos_pedidos.php">Todos os Pedidos</a>
      <a href="cadastro_clientes.php">Cadastro de Cliente</a>
      
    </div>


    <main class="main">
     <div>
          <h1 class='title'>Clientes Cadastrados</h1>
      </div>
        <div >
          <table class="table-responsive" class="lista">
            <tr>
              <th>Nome</th>
              <th>CPF</th>
              <th>Contato</th>
              <th>Consentimento</th>
              <th class="tdmenor">Excluir</th>
      		    <th class="tdmenor">Editar</th>
            </tr>

          <?php
            $sql = "select id,nome,documento,contato,consentimento from cliente;";
            $resultado = mysqli_query($bancodedados,$sql);
            while($linha = mysqli_fetch_array($resultado))
            {
              echo "<tr><td>".$linha['nome']."</td>";
              echo "<td>".$linha['documento']."</td>";
              echo "<td>".$linha['contato']."</td>";
              echo "<td>".$linha['consentimento']."</td>";
              echo "<td><a href='clientes.php?opcao=e&id=".$linha['id']."'>Excluir</a></td>";
              echo "<td><a href='clientes.php?opcao=a&id=".$linha['id']."'>Editar</a></td></tr>";

            }
          ?>

          </table>
        </div>        
  </main>
  </div>
  </body>
</html>