<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="./css/master.css" />
    <title>Esqueci minha senha</title>
    <script type="text/javascript" src="./js/mostrar_user.js"></script>
  </head>

  <body>
    <header>
      <div class='titulo'>
        <p>Recuperação de senha Tranqueira Torrent</p>
      </div>
    </header>

    <div class='bloc'>
      Digite seu login e senha nos campos abaixo.
    </div>
    <div class='alerta'>
      <span id="mostrar"></span>
      <?php
        require_once "conexao.php";
        // if (isset($_POST["submit"])) {
          $usuario = isset($_POST["usuario"]) ? trim($_POST["usuario"]) : FALSE ;
          $email = isset($_POST["email"]) ? trim($_POST["email"]) : FALSE ;

          if ($usuario) {
            $consulta ="SELECT id, nome, login, email FROM usuario WHERE login='$usuario'";
            $resultado = mysqli_query($link, $consulta) or die('Erro na query:'.mysqli_connect_error());
            $num_linhas = mysqli_num_rows($resultado);
            if ($num_linhas)
            {
                $row = $resultado->fetch_assoc();

                echo "Olá, ".$row['nome'];
                if ($email) {
                  // echo "$email";
                  if (!strcmp("".$email."", "".$row['email']."")) {
                    $com_cod = md5(uniqid(rand()));
                    $atualizar = "UPDATE usuario SET com_cod = '$com_cod' WHERE id = ".$row['id'];
                    $resultado = mysqli_query($link, $atualizar) or die("Erro ao atualizar com_code");

                    if($resultado)
                    {
                       $from = 'administracao@torrentsdownload.ml';
                       $destino = $email;
                       $assunto = 'Alteração de senha da conta: '.$row['nome'];
                       $headers = 'MIME-Version: 1.0' . PHP_EOL. 'From:' . $from . PHP_EOL . 'Reply-to:' . $from . PHP_EOL;
                       $message = 'Por favor clique no link abaixo para redefinir a sua senha:' . "\r\n";
                       $message .= 'http://localhost/web-torrent/redefinir_senha.php?passkey='.$com_cod;
                       $sentmail = mail($destino, $assunto, $message, $headers);

                       if($sentmail)
                       {
                           echo "
                           <script language='JavaScript'>
                           window.alert('Foi enviado um e-mail de confirmação para o seu endereço: $email. Clique para voltar à página inicial.')
                           window.location.href='index.php';
                           </script>";
                       }
                       else
                       {
                           echo "
                           <script language='JavaScript'>
                           window.alert('Não foi possível enviar um e-mail de confirmação para o seu endereço de e-mail. Clique para voltar à página inicial.')
                           window.location.href='index.php';
                           </script>";
                       }
                     }

                    echo "<br>um link foi enviado para o email: ".$row['email'];
                  }
                  else {
                    echo "<br>E-mails não coincidem";
                  }
                }
            }
            else {
              echo "Usuário $usuario não encontrado.";
            }
          }
        // }
      ?>
    </div>
    <div class='container'>
      <form method="POST" action="recuperar_senha.php">
          <div class="form-input">
            <?php
              if ($usuario) {
                echo "<input onfocusout='submit()' placeholder='$usuario' id='user' type='text' value='$usuario' name='usuario'/>";
              }
              else {
                echo "<input onfocusout='submit()' placeholder='Usuário' id='user' type='text' name='usuario' autofocus required/>";
              }
            ?>
          </div>
          <div class="form-input">
            <?php
              if ($num_linhas) {
                echo "<div>Insira seu e-mail cadastrado abaixo</div>";
                echo "<input placeholder='Email' id='email' type='email' name='email' required/>";
              }
            ?>
          </div>

          <div class="form-input">
            <input id="btn-login" type="submit" value="Enviar" />
          </div>

          <!-- <div class="infos">
            <div class="infos-link1">
              <a class="link" href="cadastro.php">Cadastre-se</a>
            </div>
            <div class="infos-link2">
              <a class="link" href="#">Esqueci minha senha</a>
            </div>
          </div> -->
      </form>
    </div>

    <div class="rodape">
      <p class="titulo">
        Todos os direitos reservados &copy; Eu num sei meo doismewediz8
      </p>
    </div>

  </body>

</html>
