<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Gestão de Eventos">
    <meta name="author" content="Quarto Periodo SI">

    <title>Todos os Pedidos</title>
     <link rel="stylesheet" href="../styles/root.css">
     <link rel="stylesheet" href="../styles/index.css">
     <link rel="stylesheet" href="../styles/navbar.css">
     <link rel="stylesheet" href="../styles/lista.css">
  </head>
  <body>
<<<<<<< Updated upstream
   <?php require_once(__DIR__ . '/../conecta.php'); ?>
=======
   <?php require_once(__DIR__ . '/../conecta.php'); 
      if(isset($_GET['opcao']))
      {
        if($_GET['opcao']=='e')
        {
            $id = $_GET['id'];
            $sql = "delete from pedido where id = $id";
            mysqli_query($bancodedados,$sql);
        }
      }
        ?>
>>>>>>> Stashed changes
  <div class="navbar"> 
      <a href="../index.html">Inicio</a> 
      <a href="novo_pedido.php">Novo Pedido</a> 
      <a href="cadastro_clientes.php">Cadastro de Cliente</a>
      <a href="clientes_cadastrados.php">Clientes Cadastrados</a>
    </div>
  <main class="main">
   <div>
    <h1 class='title'> Pedidos Cadastrados</h1>
  </div>
  <div class="table-responsive" class="lista">
    <table>
      <tr>
        <th>Cliente</th>
        <th>Canal de Venda</th>
<<<<<<< Updated upstream
        <th>Setror</th>
=======
        <th>Setor</th>
>>>>>>> Stashed changes
        <th>Lote</th>
        <th>Quantidade</th>
        <th>Valor Bruto</th>
        <th>Taxa</th>
        <th>Desconto</th>
        <th>Total Liquido</th>
        <th>Status</th>
        <th>Data de Expiração</th>
        <th>Data de Criação</th>
        <th class="tdmenor">Excluir</th>
      	<th class="tdmenor">Editar</th>
      </tr>
      <?php
<<<<<<< Updated upstream
        $sql = "select id,cliente_id,canal_venda,setor_id, lote_id, quantidade, valor_bruto, taxa, desconto, total_liquido, status, prazo_expiracao, data_criacao from pedido";
          $resultado = mysqli_query($bancodedados,$sql);
          while($linha = mysqli_fetch_array($resultado))
          {
            echo "<tr><td>".$linha['cliente_id']."</td>";
            echo "<td>".$linha['canal_venda']."</td>";
            echo "<td>".$linha['setor_id']."</td>";
=======
        $sql = "SELECT p.id, p.cliente_id, p.canal_venda, p.setor_id, p.lote_id, p.quantidade, p.valor_bruto, p.taxa, p.desconto, p.total_liquido, p.status, p.prazo_expiracao, p.data_criacao, c.nome AS cliente_nome, s.nome AS setor_nome FROM pedido p LEFT JOIN cliente c ON p.cliente_id = c.id LEFT JOIN setor s ON p.setor_id = s.id";
          $resultado = mysqli_query($bancodedados,$sql);
          while($linha = mysqli_fetch_array($resultado))
          {
            $clienteExibido = isset($linha['cliente_nome']) && $linha['cliente_nome'] !== '' ? $linha['cliente_nome'] : $linha['cliente_id'];
            $setorExibido = isset($linha['setor_nome']) && $linha['setor_nome'] !== '' ? $linha['setor_nome'] : $linha['setor_id'];
            echo "<tr><td>".$clienteExibido."</td>";
            echo "<td>".$linha['canal_venda']."</td>";
            echo "<td>".$setorExibido."</td>";
>>>>>>> Stashed changes
            echo "<td>".$linha['lote_id']."</td>";
            echo "<td>".$linha['quantidade']."</td>";
            echo "<td>".$linha['valor_bruto']."</td>";
            echo "<td>".$linha['taxa']."</td>";
            echo "<td>".$linha['desconto']."</td>";
            echo "<td>".$linha['total_liquido']."</td>";
            echo "<td>".$linha['status']."</td>";
            echo "<td>".$linha['prazo_expiracao']."</td>";
            echo "<td>".$linha['data_criacao']."</td>";
<<<<<<< Updated upstream
            echo "<td><a href='pedidos.php?opcao=e&id=".$linha['id']."'>Excluir</a></td>";
            echo "<td><a href='pedidos.php?opcao=a&id=".$linha['id']."'>Editar</a></td></tr>";
=======
            echo "<td><a href='todos_pedidos.php?opcao=e&id=".$linha['id']."'>Excluir</a></td>";
            echo "<td><a href='novo_pedido.php?opcao=a&id=".$linha['id']."'>Editar</a></td></tr>";
>>>>>>> Stashed changes
          }
      ?>
    </table>
  </div>        
</main>
</div>
</body>
</html>