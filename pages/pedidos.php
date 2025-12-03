<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Gestão de Eventos">
    <meta name="author" content="Quarto Periodo SI">

    <title>Cadastro de Pedido</title>

  </head>
  <body>
    <?php
      include_once('conecta.php');
      if(isset($_GET['opcao']))
      {
        if($_GET['opcao']=='e')
        {
            $id = $_GET['id'];
            $sql = "delete from pedido where id = $id";
            mysqli_query($bancodedados,$sql);
        }
        if($_GET['opcao']=='a')
        {
          $id = $_GET['id'];
          $sql = "select * from pedido where id = $id";
          $resultado = mysqli_query($bancodedados,$sql);
          if ($linha = mysqli_fetch_array($resultado))
          {
            $cliente_id = $linha['cliente_id'];
            $canal_venda = $linha['canal_venda'];
            $setor_id = $linha['setor_id'];
            $lote_id = $linha['lote_id'];
            $quantidade = $linha['quantidade'];
            $valor_bruto = $linha['valor_bruto'];
            $taxa = $linha['taxa'];
            $desconto = $linha['desconto'];
            $total_liquido = $linha['total_liquido'];
            $status = $linha['status'];
            $prazo_expiracao = $linha['prazo_expiracao'];
          }
        }
      }
    ?>
   <h1 class=>Cadastrar Pedido</h1>
      <div >
        <form action="pedidos.php" method="POST">
         <div>
          <label for="cliente">Cliente</label>
            <select class="form-control" name="cliente" id="cliente">

              <?php
               $sql = "select * from cliente";
                $resultado = mysqli_query($bancodedados,$sql);
                while($linha = mysqli_fetch_array($resultado))
                {
                 if(isset($cliente_id) && $cliente_id == $linha['id'])
                   echo "<option selected value='".$linha['id']."'>".$linha['nome']."</option>";  
                  else
                   echo "<option value='".$linha['id']."'>".$linha['nome']."</option>";
                }
              ?>              
            </select>
          <div>
            <label for="canal_venda">Canal de Venda</label>
              <select class="form-control" name="canal_venda" id="canal_venda">
                <?php
                  $opcoes = array('Ecommerce','Comissario','Bilheteria');
                  foreach($opcoes as $op) {
                    $sel = (isset($canal_venda) && $canal_venda == $op) ? ' selected' : '';
                    echo "<option$sel>$op</option>";
                  }
                ?>
            </select>
          <div>
            <label for="setor">Setor</label>
              <select class="form-control" name="setor" id="setor">
                <?php
                  $sql = "select * from setor";
                  $resultado = mysqli_query($bancodedados,$sql);
                  while($linha = mysqli_fetch_array($resultado))
                  {
                    if(isset($setor_id) && $setor_id == $linha['id'])
                    echo "<option selected value='".$linha['id']."'>".$linha['setor']."</option>";  
                    else
                    echo "<option value='".$linha['id']."'>".$linha['setor']."</option>";
                  }
                ?>      
              </select>
            <div>
              <label for="lote">Lote</label>
                <select class="form-control" name="lote" id="lote">
                  <?php
                    $sql = "select * from lote";
                    $resultado = mysqli_query($bancodedados,$sql);
                    while($linha = mysqli_fetch_array($resultado))
                    {
                      if(isset($lote_id) && $lote_id == $linha['id'])
                      echo "<option selected value='".$linha['id']."'>".$linha['lote']."</option>";  
                      else
                      echo "<option value='".$linha['id']."'>".$linha['lote']."</option>";
                    }
                  ?>     
                </select>
            </div>
            <div>
              <label for="quantidade">Quantidade</label>
                <input required value="<?php if(isset($quantidade)) echo $quantidade;?>" type="text" class="form-control" id="quantidade" name="quantidade" placeholder="Somente numeros" size="60">
            </div>
            <div>
              <label for="valor_bruto">Valor Bruto</label>
                <input required value="<?php if(isset($valor_bruto)) echo $valor_bruto; ?>"  class="form-control" id="valor_bruto" name="valor_bruto" size="60"> 
            </div>
            <div>
              <label for="taxa">Taxa</label>
              <input required value="<?php if(isset($taxa)) echo $taxa; ?>"  class="form-control" id="taxa" name="taxa" size="60"> 
            </div>
            <div>
              <label for="desconto">Desconto</label>
                <input required value="<?php if(isset($desconto)) echo $desconto; ?>"  class="form-control" id="desconto" name="desconto" size="60"> 
            </div>
            <div>
              <label for="total_liquido">Total Liquido</label>
                <input required value="<?php if(isset($total_liquido)) echo $total_liquido; ?>"  class="form-control" id="total_liquido" name="total_liquido" size="60"> 
            </div>
            <div>
              <label for="status">Status</label>
                <select class="form-control" name="status" id="status">
                  <option>Pendente</option>
                  <option>Aprovado</option>
                  <option>Recusado</option>
                  <option>Estornado</option>
                  <option>Expirado</option>     
                </select>
            </div>
            <div>
              <label for="prazo_expiracao">Data de expiração</label>
                <input type="date" class="form-control" name="prazo_expiracao" id="prazo_expiracao">
                </input>

            <?php
              if(isset($_GET['opcao']) && $_GET['opcao']=='a')
              {
            ?>
              <input type="hidden" name="id" value="<?php echo $id;?>"> 
            <?php
              }
            ?>
          </div>
        
            <br>
            <input type="submit" value="Gravar">
      </form>
    </div>
    <div>
      <?php
        if(isset($_POST['cliente']))
        {
          if(isset($_POST['id']))
          {
            $id = $_POST['id'];
            $cliente = $_POST['cliente'];
            $canal_venda = $_POST['canal_venda'];
            $setor = $_POST['setor'];
            $lote = $_POST['lote'];
            $quantidade = $_POST['quatidade'];
            $valor_bruto = $_POST['valor_bruto'];
            $taxa = $_POST['taxa'];
            $desconto = $_POST['desconto'];
            $total_liquido = $_POST['total_liquido'];
            $status = $_POST['status'];
            $prazo_expiracao = $_POST['prazo_expiracao'];
            $data_criacao = $_POST['data_criacao'];
            $sql = "update pedido set id = $id, cliente_id='$cliente', canal_venda = '$canal_venda', setor = '$setor', lote = '$lote', quantidade = '$quantidade', valor_bruto = '$valor_bruto', taxa = '$taxa', desconto = '$desconto', total_liquido = '$total_liquido', status = '$status', prazo_expiracao = '$prazo_expiracao', data_criacao = '$data_criacao' where id = $id";
            mysqli_query($bancodedados,$sql);

          }
          else {
            $id = $_POST['id'];
            $cliente = $_POST['cliente'];
            $canal_venda = $_POST['canal_venda'];
            $setor = $_POST['setor'];
            $lote = $_POST['lote'];
            $quantidade = $_POST['quantidade'];
            $valor_bruto = $_POST['valor_bruto'];
            $taxa = $_POST['taxa'];
            $desconto = $_POST['desconto'];
            $total_liquido = $_POST['total_liquido'];
            $status = $_POST['status'];
            $prazo_expiracao = $_POST['prazo_expiracao'];
            $data_criacao = date('Y-m-d H:i:s');
            $sql = "insert into pedido (cliente_id,canal_venda,setor,lote,quantidade,valor_bruto,taxa,desconto,total_liquido,status,prazo_expiracao,data_criacao) values ('$cliente','$canal_venda','$setor','$lote','$quantidade','$valor_bruto','$taxa','$desconto','$total_liquido','$status','$prazo_expiracao','$data_criacao')";
            mysqli_query($bancodedados,$sql);  
          }

        }
      ?>
  <div>    
    <h2 class="display-6"> Pedidos Cadastrados</h2>
  </div>
  <div >
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
</div>
</body>
</html>