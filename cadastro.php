<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="./css/master.css" />
    <title>Cadastro</title>
    <script type="text/javascript" src="./js/control.js"></script>
  </head>

  <body>
    <header>
      <div class="titulo">
        <p>Cadastro Tranqueira Torrent</p>
      </div>
    </header>

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
          <input placeholder="* Obrigatório" id="senha" type="password" name="senha" required/>
        </div>

        <div>
          <label for="email">Email:</label>
          <input placeholder="* Obrigatório" id="email" type="email" name="email" required/>
        </div>

        <div class="infos">
          <input type="button" value="Cadastrar" onclick="verificarForm()"/>
          <input type="reset" name="reset" value="Limpar">
        </div>

      </form>
    </div>

    <div class="rodape">
      <p class="titulo">
        Todos os direitos reservados &copy; Eu num sei meo doismewediz8
      </p>
    </div>

  </body>

</html>
