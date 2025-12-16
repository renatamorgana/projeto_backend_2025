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
   <?php require_once(__DIR__ . '/../conecta.php'); ?>
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
        <th>Setror</th>
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
        $sql = "select id,cliente_id,canal_venda,setor_id, lote_id, quantidade, valor_bruto, taxa, desconto, total_liquido, status, prazo_expiracao, data_criacao from pedido";
          $resultado = mysqli_query($bancodedados,$sql);
          while($linha = mysqli_fetch_array($resultado))
          {
            echo "<tr><td>".$linha['cliente_id']."</td>";
            echo "<td>".$linha['canal_venda']."</td>";
            echo "<td>".$linha['setor_id']."</td>";
            echo "<td>".$linha['lote_id']."</td>";
            echo "<td>".$linha['quantidade']."</td>";
            echo "<td>".$linha['valor_bruto']."</td>";
            echo "<td>".$linha['taxa']."</td>";
            echo "<td>".$linha['desconto']."</td>";
            echo "<td>".$linha['total_liquido']."</td>";
            echo "<td>".$linha['status']."</td>";
            echo "<td>".$linha['prazo_expiracao']."</td>";
            echo "<td>".$linha['data_criacao']."</td>";
            echo "<td><a href='pedidos.php?opcao=e&id=".$linha['id']."'>Excluir</a></td>";
            echo "<td><a href='pedidos.php?opcao=a&id=".$linha['id']."'>Editar</a></td></tr>";
          }
      ?>
    </table>
  </div>        
</main>
</div>
</body>
</html>