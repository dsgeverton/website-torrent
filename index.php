<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="oloco bixo" content="">
    <meta title="Baixador de torrents" content="">
    <title>Torrents Download</title>
    <script type="text/javascript" src="./js/control.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/style-index.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
  </head>
  <body>
    <header>
      <figure id="logo">
        <img id="logo-header" src="./img/bittorrent-logo.png" alt="Logo">
      </figure>
      <div class="logoBar">
        <nav class="menu">
          <ul class="menu-list">
            <li class="menu-list-item"><a class="item-anchor-menu" href="index.php">Home</a></li>
            <li class="menu-list-item"> <a class="item-anchor-menu" href="#">Todos</a></li>
          </ul>
        </nav>
        <?php

          session_start();
            function verificarSessao()
            {
              if (empty($_SESSION['nome_usuario']) || empty($_SESSION['login_usuario'])) {
                return 0;
              } else {
                return 1;
              }
            }

          if (!verificarSessao()) {
            $sessao = "<ul class='navbar-1'>
                        <li class='navbar-login'><a rel='nofollow' class='' href='login.html'>Login</a></li>
                        <li class='navbar-cadastrar'><a rel='nofollow' href='cadastro.php'>Cadastrar</a></li>
                      </ul>";
          }
          else {
            $sessao = "<ul class='navbar-1'>
                        <li class='navbar-login'><a rel='nofollow' >". $_SESSION['nome_usuario'] ."</a></li>";


            if ($_SESSION['nome_usuario'] == "Administrador" || $_SESSION['login_usuario'] == "admin") {
              $sessao = $sessao . "<li class='navbar-cadastrar'><a rel='nofollow' href=''>Cadastrar Torrent</a></li>
                                   <li class='navbar-cadastrar'><a rel='nofollow' href=''>Cadastrar Categoria</a></li>
                                  ";
          }
          $sessao = $sessao . "<li class='navbar-cadastrar'><a rel='nofollow' href='sair.php'>Sair</a></li></ul>";
        }

          echo $sessao;
        ?>
      </div>
    </header>
    <section class="corpo-principal">
      <article class="pesquisa">
        <p class="title">Busque pelo torrent desejado</p>
        <form class="" action="index.php" method="get">
          <div class="sBar">
           <label id="lupa-icon" for="caixa">?</label>
           <input id="input-pesquisar" type="text" name="pesquisa" value="" placeholder="Nome do torrent">
           <button class="botao" type="submit"> <img src="./img/lupa.png" alt=""> </button>
           <?php
            $pesquisa = isset($_GET['pesquisa']) ? trim($_GET['pesquisa']) : FALSE;
            if ($pesquisa) {
              $consulta_pesquisa = "SELECT torrent.nome, torrent.descricao, torrent.link_img, torrent.link_server FROM torrent WHERE torrent.nome LIKE '". $pesquisa ."%'";
            }
            else {

            }
           ?>
         </div>
        </form>
      </article>
      <section class="torrents">
        <div class="flutuar-lateral">
          <aside class="info-lateral">
            <?php
            include_once 'conexao.php';
            $consulta = "SELECT COUNT(nome) as valor FROM usuario";
            $resultado = mysqli_query($link, $consulta) or die("erro na consulta");
            $resultado = $resultado->fetch_assoc();
            $last_id = mysqli_insert_id($link);
            echo "<div>Número de usuários cadastrados: <span id='user-cadastros'>". $resultado['valor'] ."</span></div>";
            ?>
          </aside>
          <aside class="info-lateral">
            <p>Canal no YouTube</p>
              <iframe id="frame-video" src="https://www.youtube.com/embed/nbm_WEJi0R4" allow="autoplay; encrypted-media" allowfullscreen></iframe>
          </aside>

          <aside class="info-lateral">
            <audio controls style='width: 100%'>
             <source src="./sound/teste.mp3" type="audio/mpeg">
             Your browser does not support the audio element.
            </audio>
          </aside>

        </div>

        <section class="post-torrent">
          <div class="busca-categoria">
            <form name="categoria" class="" action="index.php" method="get">
            <table>
              <tr>
                <td><label class="categoria" for="categoria"> Buscar por categoria: </label></td>
                <td>
                  <select class="categoria-lista" onchange="submit()" name="categoria">
                    <?php
                      try {
                        include_once 'conexao.php';
                      } catch (\Exception $e) {
                        echo "Falha na conexão com o Banco de Dados";
                      }
                      $consulta = "SELECT nome FROM categoria";
                      $resultado = mysqli_query($link, $consulta) or die("erro na consulta");
                      if (mysqli_num_rows($resultado) > 0) {
                        echo "<option> Selecione </option>";
                        while ($row = $resultado->fetch_assoc()) {
                          echo "<option value=". $row['nome'] . ">". $row['nome'] ."</option>";
                        }
                      }
                      else {
                        echo "<option value='null'>Nenhuma categoria encontrada</option>";
                      }
                    ?>
                  </select>
                </td>
              </tr>
            </table>
          </form>
          </div>
          <div class="mostrar-categoria">
          <?php
            $categoria_post = isset($_GET['categoria']) ? trim($_GET['categoria']) : FALSE;
            if ($categoria_post) {
              echo "<div class='categoria-selected'>
              ". strtoupper($categoria_post) ."
              </div>";
              $consulta_pesquisa = "SELECT torrent.nome, torrent.descricao, torrent.link_img, torrent.link_server FROM torrent INNER JOIN categoria ON torrent.id_categoria = categoria.id WHERE categoria.nome = '$categoria_post'";
            }
            // mostrarPesquisa();
              if (!empty($consulta_pesquisa)) {
              $resultado = mysqli_query($link, $consulta_pesquisa) or die("");
              if (mysqli_num_rows($resultado)) {
                while ($row = mysqli_fetch_assoc($resultado)) {
                  echo "<article class='post'>
                  <figure id='post-fig'>
                  <img class='post-img' src='". $row['link_img'] ."' alt=''>
                  </figure>
                  <div class=''>
                  <table class='post-table'>
                  <tr class='post-table-row'>
                  <th> Nome </th>
                  <td> <span class='conteudo'>". $row['nome'] ."</span> </td>
                  </tr>
                  <tr class='post-table-row'>
                  <th> Descrição </th>
                  <td> <span class='conteudo'>". $row['descricao'] ."</span> </td>
                  </tr>
                  <tr class='post-table-row-download'>
                  <th> Baixar </th>";
                  if (verificarSessao()) {
                    echo "<td> <a id='user-cadastros' href='". $row['link_server'] ."'> Download </a> </td>";
                  } else{
                    echo "<td> <a id='user-cadastros-fail' href='login.html' > Faça o login para baixar </a> </td>";
                  }
                  echo "      </tr>
                  </table>
                  </div>
                  </article>";
                }
              }
              else {
                echo "<p>Nenhum resultado encontrado!</p>";
              }
            }
          ?>
          </div>
        </section>
      </section>
    </section>
    <footer>
      <div class="contato">
        <table style="">
          <tr>
            <th>Contato</th>
            <td>(22) 9 9858 - 0802</td>
          </tr>
          <tr>
            <th>Email</th>
            <td>dsgeverton@gmail.com</td>
          </tr>
          <tr>
            <th colspan="2">Everton Gonçalves</th>
            <td></td>
          </tr>
          <tr>
            <td colspan="2"> <a style="text-decoration:none; color:white;" href="https://www.dsgeverton.wordpress.com">Visite meu Blog</a></td>
          </tr>
        </table>
      </div>
      <div class="anuncio">
        <p>ME DIRRUBARO AQUI Ó</p>
        <p>NUM VAI DAR NÃO</p>
        <p>MAS O QUE É ISSO</p>
      </div>
      <div class="info">
        <span>All rights reserved Everoot Development &copy; 2018</span>
      </div>
    </footer>
  </body>
</html>
