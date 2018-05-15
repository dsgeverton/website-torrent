<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="./css/master.css" />
    <title>Cadastro</title>
    <script type="text/javascript" src="./js/control.js">

    </script>
  </head>

  <body>
    <header>
      <div class="titulo">
        <p>Cadastro Tranqueira Torrent</p>
      </div>
    </header>
    <?php
    require 'conexao.php';

    $nome_usuario = trim($_POST["nome"]);
    $login_usuario = trim($_POST["usuario"]);
    $senha_usuario = md5($_POST["senha"]);
    $email_usuario = trim($_POST["email"]);

    $consulta = "SELECT login, email FROM usuario";
    $resultado = mysqli_query($link, $consulta) or die("Erro no Banco de Dados". mysqli_connect_error());
    $erro = array();
    $validacao = 0;
    while ($row = $resultado->fetch_assoc())
    {
      if (!strcmp("".$login_usuario."", "".$row["login"].""))
      {
        $erro[] = "usuário";
      }
      if (!strcmp("".$email_usuario."", "".$row["email"].""))
      { $erro[] = "email";}
    }
    $val = count($erro);
    if ($val) {
      switch ($val) {
        case '1':
          ?>
          <div id="validacao-fail">
            <span> <?php echo "Este $erro[0] já está cadastrado no sistema.";?> </span>
          </div>
          <?php
          break;

        case '2':
          ?>
          <div id="validacao-fail">
            <span> <?php echo "Os $erro[0] e $erro[1] já estão cadastrados.";?> </span>
          </div>
          <?php
          break;
      }
    }


    if (!$val)
    {
      $consulta = "INSERT INTO usuario (nome, login, senha, email) VALUES
      ('$nome_usuario','$login_usuario','$senha_usuario','$email_usuario')";

      $resultado = mysqli_query($link,$consulta) or die("Erro ao Cadastrar");
      ?>
      <div id="validacao-ok">
        <span> <?php echo "Cadastro efetuado com sucesso.";?> </span>
      </div>
      <?php
      $validacao = 1;
    }
    ?>

    <div class='container'>
      <form name="registro" method="post" action="registrar.php">
        <div>
          <label for="nome">Nome:</label>
          <input placeholder="* Obrigatório" id="nome" type="text" name="nome" autofocus required/>
        </div>

        <div>
          <label for="usuario">Usuário:</label>
          <input placeholder="* Obrigatório" id="usuario" type="text" name="usuario" required/>
        </div>

        <div>
          <label for="senha">Senha:</label>
          <input min="8" placeholder="* Obrigatório" id="senha" type="password" name="senha" required/>
        </div>

        <div>
          <label for="email">Email:</label>
          <input placeholder="* Obrigatório" id="email" type="email" name="email" />
        </div>

        <div class="infos">
          <input type="button" value="Cadastrar" onclick="verificarForm()"/>
          <input type="reset" name="reset" value="Limpar">
        </div>

      </form>
    </div>

    <?php
      if ($validacao) {
        ?><div class="voltar">
        <a id="voltar-link" href="login.html">Voltar</a>
      </div><?php
      }
    ?>

    <div class="rodape">
      <p class="titulo">
        Todos os direitos reservados &copy; Eu num sei meo doismewediz8
      </p>
    </div>

  </body>

</html>
