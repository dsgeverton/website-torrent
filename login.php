<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="./css/master.css" />
    <title>Login</title>

  </head>

  <body>
    <header>
      <div class='titulo'>
        <p>Login Tranqueira Torrent</p>
      </div>
    </header>

    <div class='bloc'>
      Digite seu login e senha nos campos abaixo.
    </div>
    <div class='alerta'>
      <?php
      require "conexao.php";
      session_start();
      $login = isset($_POST["usuario"]) ? trim($_POST["usuario"]) : FALSE ;
      $senha = isset($_POST["senha"]) ? md5($_POST["senha"]) : FALSE ;

      $consulta ="SELECT nome, login, senha FROM usuario WHERE login='$login' AND senha='$senha'";
      $resultado = $link->query($consulta) or die('Erro na query:'.mysqli_connect_error());
      $num_linhas = mysqli_num_rows($resultado);

      if (!$num_linhas) {
        echo "Usuário ou senha incorretos";
        session_start();
        $_SESSION['warning'] += 1;
      }
      else {
        $row = $resultado->fetch_assoc();
        $_SESSION["nome_usuario"] = $row["nome"];
        $_SESSION["login_usuario"] = $row["login"];
        header("Location:index.php");
      }

      ?>
    </div>
    <div class='container'>
      <form method="post" action="login.php">
          <div class="form-input">
            <input placeholder="Usuário" id="user" type="text" name="usuario" autofocus required/>
          </div>
          <div class="form-input">
            <input placeholder="Senha" id="pass" type="password" name="senha" required/>
          </div>

          <div class="form-input">
            <input id="btn-login" type="submit" value="Login" />
          </div>

          <div class="infos">
            <div class="infos-link1">
              <a class="link" href="cadastro.php">Cadastre-se</a>
            </div>
            <?php
              if (!$num_linhas) {
                echo "<div class='infos-link2'>";
                echo "<a class='link2' href='recuperar_senha.php'>Esqueci minha senha</a>";
                echo "</div>";
              }
            ?>
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
