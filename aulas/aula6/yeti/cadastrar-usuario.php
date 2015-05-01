<?php

include "classes/Database.php";
include "classes/validation-2.3.3.php";

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
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Themes <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a href="../default/">Default</a></li>
                <li class="divider"></li>
                <li><a href="../cerulean/">Cerulean</a></li>
                <li><a href="../cosmo/">Cosmo</a></li>
                <li><a href="../cyborg/">Cyborg</a></li>
                <li><a href="../darkly/">Darkly</a></li>
                <li><a href="../flatly/">Flatly</a></li>
                <li><a href="../journal/">Journal</a></li>
                <li><a href="../lumen/">Lumen</a></li>
                <li><a href="../paper/">Paper</a></li>
                <li><a href="../readable/">Readable</a></li>
                <li><a href="../sandstone/">Sandstone</a></li>
                <li><a href="../simplex/">Simplex</a></li>
                <li><a href="../slate/">Slate</a></li>
                <li><a href="../spacelab/">Spacelab</a></li>
                <li><a href="../superhero/">Superhero</a></li>
                <li><a href="../united/">United</a></li>
                <li><a href="../yeti/">Yeti</a></li>
              </ul>
            </li>
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

    
      <!-- Forms
      ================================================== -->

        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h1 id="forms">Usuário</h1>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="well bs-component">

              <?php

              $dados = [
                'nome' => '',
                'email' => '',
                'senha' => '',
                'senha_confirmacao' => '',
              ];

              $errors = [];
              $success = [];

              $rules = array();

              // Se detectou que o post foi realizado
              if(isset($_POST['usuario'])){
                
                $dados['nome'] = $_POST['usuario']['nome'];
                $dados['email'] = $_POST['usuario']['email'];
                $dados['senha'] = $_POST['usuario']['senha'];
                $dados['senha_confirmacao'] = $_POST['usuario']['senha_confirmacao'];


                // Validar nome
                 $rules[] = "required,nome,É necessário digitar um nome!";
                 $rules[] = "required,email,É necessário digitar um e-mail!";
                 $rules[] = "required,senha,É necessário digitar uma senha!";

                 $rules[] = "length<=10,nome,O nome tem que ter no maximo 60 caracteres.";

                 $rules[] = "same_as,senha,senha_confirmacao,Por favor as senhas devem ser identicas.";

 

                 $errors = validateFields($dados, $rules);

                 if(count($errors) == 0){

                  $insert = [
                    'nome' => $dados['nome'],
                    'email' => $dados['email'],
                    'senha' => md5($dados['senha']),
                  ];

                  if($db->insert($insert)){
                    $success[] = "Usuario criado com sucesso!";

                    
                    $dados = [
                      'nome' => '',
                      'email' => '',
                      'senha' => '',
                      'senha_confirmacao' => '',
                    ];

                  }
                 }

                // Validar o nome
                // if(strlen($dados['nome']) == 0){
                //   $errors[] = "É necessário digitar um nome!";
                // }

                // if(strlen($dados['nome']) > 60){
                //   $errors[] = "O nome do usuário tem que ter no maximo 60 caracteres!";
                // }

                // if(strlen($dados['email']) == 0){
                //   $errors[] = "É necessário digitar um e-mail!";
                // }

                // // Validar e-mail
                // if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
                //   $errors[] = "Por favor digite um e-mail valido!"; 
                // }

                // if(strlen($dados['senha']) == 0){
                //   $errors[] = "É necessário digitar uma senha!";
                // }

              }

              ?>

              <?php
              if(count($errors) > 0 ):
              ?>


                <div class="alert alert-danger" role="alert">

                  <?php
                    foreach($errors as $error):
                  ?>

                    <?= $error ?> <br>

                  <?php 
                    endforeach; 
                  ?>

                </div>

              <?php
              endif;
              ?>

              <?php
              if(count($success) > 0 ):
              ?>

              <div class="alert alert-success" role="alert">

                    <?= $success[0] ?> <br>

                </div>

              <?php
              endif;
              ?>

              <form class="form-horizontal" method="post" autocomplete="off">

                <fieldset>
                  <legend>Cadastrar</legend>

                   <div class="form-group">
                    <label for="inputNome" class="col-lg-2 control-label">Nome</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="usuario[nome]" placeholder="Nome" value="<?= $dados['nome'] ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="usuario[email]" placeholder="Email" value="<?= $dados['email'] ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPassword" class="col-lg-2 control-label">Senha</label>
                    <div class="col-lg-10">
                      <input type="password" class="form-control" name="usuario[senha]" placeholder="Senha" value="<?= $dados['senha'] ?>">                      
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPasswordConfirm" class="col-lg-2 control-label">Confirmacao</label>
                    <div class="col-lg-10">
                      <input type="password" class="form-control" name="usuario[senha_confirmacao]" placeholder="Senha" value="<?= $dados['senha_confirmacao'] ?>">                      
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                      <button type="reset" class="btn btn-default">Limpar</button>
                      <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                  </div>

                </fieldset>
              </form>
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
