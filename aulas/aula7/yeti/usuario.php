<?php

// Classe de banco de dados
include "classes/Database.php";

// Para utilizarmos a variavel de sessão é necessario executar este metodo.
session_start();

// Criação de uma instancia da classe de banco 
$db = new Database("usuario");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootswatch: Yeti</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/bootswatch.min.css" media="screen">  
  </head>
  <body>
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="../" class="navbar-brand">Bootswatch</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            
            <li>
              <a href="../help/">Help</a>
            </li>
            <li>
              <a href="http://news.bootswatch.com">Blog</a>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Download <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="download">
                <li><a href="./bootstrap.min.css">bootstrap.min.css</a></li>
                <li><a href="./bootstrap.css">bootstrap.css</a></li>
                <li class="divider"></li>
                <li><a href="./variables.less">variables.less</a></li>
                <li><a href="./bootswatch.less">bootswatch.less</a></li>
                <li class="divider"></li>
                <li><a href="./_variables.scss">_variables.scss</a></li>
                <li><a href="./_bootswatch.scss">_bootswatch.scss</a></li>
              </ul>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="http://builtwithbootstrap.com/" target="_blank">Built With Bootstrap</a></li>
            <li><a href="https://wrapbootstrap.com/?ref=bsw" target="_blank">WrapBootstrap</a></li>
          </ul>

        </div>
      </div>
    </div>


    <div class="container">

      <!-- Tables
      ================================================== -->


        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">

              <h1 id="tables">Usuários</h1>
              <a href="cadastrar-usuario.php" class="btn btn-primary">Cadastrar</a>
              
            </div>

            <div class="bs-component">


              <?php
              // Exibe a mensagem de sucesso 
              if(isset($_SESSION['mensagem'])):
              ?>

              <div class="alert alert-success" role="alert">

                    <?= $_SESSION['mensagem'] ?> <br>

                </div>

              <?php
                // Destroi a variavel de sessao com a mensagem de sucesso
                // Assim a mensagem é mostrada somente uma vez
                unset($_SESSION['mensagem']);
              endif;
              ?>

              <table class="table table-striped table-hover ">
                <thead>
                  <tr>
                    <th width="10%">#</th>
                    <th width="40%">Nome</th>
                    <th width="30%">E-mail</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>

                  <?php

                  // Recupera todos dados da tabela usuario
                  $rows = $db->queryAll();

                  ?>

                  <?php
                    // Executa um loop para mostrar os dados do usuario
                    foreach($rows as $row):
                  ?>

                  <tr>
                    <td><?= $row['codigo'] ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?= $row['email'] ?></td>
                    <td>

                      <div class="btn-group" role="group">
                        <a href="alterar-usuario.php?codigo=<?= $row['codigo'] ?>" class="btn btn-info btn-sm">Alterar</a>
                        <a href="deletar-usuario.php?codigo=<?= $row['codigo'] ?>" class="btn btn-danger btn-sm">Deletar</a>
                      </div>

                    </td>
                  </tr>

                  <?php
                  endforeach;
                  ?>

                  
                </tbody>
              </table> 
            </div><!-- /example -->
          </div>
        </div>
    
      

      

      <footer>
        <div class="row">
          <div class="col-lg-12">

            <ul class="list-unstyled">
              <li class="pull-right"><a href="#top">Back to top</a></li>
              <li><a href="http://news.bootswatch.com" onclick="pageTracker._link(this.href); return false;">Blog</a></li>
              <li><a href="http://feeds.feedburner.com/bootswatch">RSS</a></li>
              <li><a href="https://twitter.com/bootswatch">Twitter</a></li>
              <li><a href="https://github.com/thomaspark/bootswatch/">GitHub</a></li>
              <li><a href="../help/#api">API</a></li>
              <li><a href="../help/#support">Support</a></li>
            </ul>
            <p>Made by <a href="http://thomaspark.co" rel="nofollow">Thomas Park</a>. Contact him at <a href="mailto:thomas@bootswatch.com">thomas@bootswatch.com</a>.</p>
            <p>Code released under the <a href="https://github.com/thomaspark/bootswatch/blob/gh-pages/LICENSE">MIT License</a>.</p>
            <p>Based on <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts" rel="nofollow">Google</a>.</p>

          </div>
        </div>

      </footer>


    </div>


    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
