<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Gestão de Eventos">
    <meta name="author" content="Quarto Periodo SI">

    <title>Cadastro de Clientes</title>

  </head>
  <body>

    <?php
      include_once('conecta.php');
      if(isset($_GET['opcao']))
      {
        if($_GET['opcao']=='e')
        {
            $id = $_GET['id'];
            $sql = "delete from cliente where id = $id";
            mysqli_query($bancodedados,$sql);
        }
        if($_GET['opcao']=='a')
        {
          $id = $_GET['id'];
          $sql = "select * from cliente where id = $id";
          $resultado = mysqli_query($bancodedados,$sql);
          if ($linha = mysqli_fetch_array($resultado))
          {
            $nome = $linha['nome'];
            $documento = $linha['documento'];
            $contato = $linha['contato'];
            $consentimento = $linha['consentimento'];
          }
        }
      }
    ?>
   <h1 class=>Cadastro de Usuário</h1>
        <div >
          <form action="clientes.php" method="POST">
            <div>
              <label for="nome">Nome</label>
                <input required value="<?php if(isset($nome)) echo $nome;?>" type="text" class="form-control" id="nome" name="nome" placeholder="Informe o nome do cliente" size="60">
            </div>
            <div>
              <label for="documento">CPF</label>
                <input required value="<?php if(isset($documento)) echo $documento; ?>"  class="form-control" id="documento" name="documento" placeholder="Somente numeros" size="60"> 
            </div>
            <div class="form-group">
              <label for="contato">Telefone</label>
                <input required value="<?php if(isset($contato)) echo $contato; ?>"  class="form-control" id="contato" name="contato" placeholder="Somente numeros" size="60"> 
            </div>
            <div>
              <label for="consentimento_id">Aceita os termos de cadastratos?</label>
                <input type="checkbox"  name="consentimento_id" id="consentimento_id" value = "1">Aceito</input>

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
          if(isset($_POST['nome']))
          {
            if(isset($_POST['id']))
            {
              $id = $_POST['id'];
              $nome = $_POST['nome'];
              $documento = $_POST['documento'];
              $contato = $_POST['contato'];
              $consentimento = isset($_POST['consentimento_id']) ? $_POST['consentimento_id'] : '0';
              $sql = "update cliente set nome='$nome', documento = '$documento', contato = '$contato', consentimento='$consentimento' where id = $id";
              mysqli_query($bancodedados,$sql);

            }
            else {
              $nome = $_POST['nome'];
              $documento = $_POST['documento'];
              $contato = $_POST['contato'];
              $consentimento = isset($_POST['consentimento_id']) ? $_POST['consentimento_id'] : '0';
              $sql = "insert into cliente (nome,documento,contato,consentimento) values ('$nome','$documento','$contato','$consentimento')";
              mysqli_query($bancodedados,$sql);  
            }
          }
        ?>

        <div>
          <h2> Clientes Cadastrados</h2>
        </div>
        <div >
          <table>
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
  </div>
  </body>
</html>