<?php

// Classe de banco de dados
include "classes/Database.php";

// Classe de validação
include "classes/validation-2.3.3.php";

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
              // Recuperar via GET o codigo do usuario passado como referencia
              $codigo = $_GET['codigo'];

              // Recuperar do banco os dados do usuario com o codigo especificado
              $usuario = $db->queryOne($codigo);

              // Preencher todos campos com os dados do usuario
              $dados = [
                'nome' => $usuario['nome'],
                'email' => $usuario['email'],
                'senha' => $usuario['senha'],
                'senha_confirmacao' => $usuario['senha'],
                'senha_temp' => $usuario['senha'], // variavel criada para evitar que o md5 nao seja aplicado mais de uma vez
              ];

              // Criar um array para armazenar as mensagens de error
              $errors = [];

              // Criar um array para armazenar a mensagem de sucesso
              // Depois foi trocado pela variavel de sessão
              //$success = [];

              // Criar um array para armazenar as regras de validação
              $rules = array();

              // IF que detecta se foi realizado um POST no formulario
              if(isset($_POST['usuario'])){
                
                // Recuperando os dados enviados via POST
                $dados['nome'] = $_POST['usuario']['nome'];
                $dados['email'] = $_POST['usuario']['email'];
                $dados['senha'] = $_POST['usuario']['senha'];
                $dados['senha_confirmacao'] = $_POST['usuario']['senha_confirmacao'];


                 // Validações
                 // Nome e obrigatorio
                 $rules[] = "required,nome,É necessário digitar um nome!"; 
                 // Email e obrigatorio
                 $rules[] = "required,email,É necessário digitar um e-mail!"; 
                 // Senha e obrigatorio
                 $rules[] = "required,senha,É necessário digitar uma senha!"; 
                 // Confirmação de senha e obrigatorio
                 $rules[] = "required,senha_confirmacao,É necessário digitar uma senha!"; 

                 // Campo nome tem que ter no maximo 60 caracteres, conforme definimos no banco
                 $rules[] = "length<=60,nome,O nome tem que ter no maximo 60 caracteres.";

                 // Senha e confirmação tem que ser identicas
                 $rules[] = "same_as,senha,senha_confirmacao,Por favor as senhas devem ser identicas.";


                // 202cb962ac59075b964b07152d234b70
                // 202cb962ac59075b964b07152d234b70
                // 01cfcd4f6b8770febfb40cb906715822

                 // O MD5 só poderá ser aplicado na senha somente uma vez
                 // Entao devemos realizar uma checagem, caso o usuario nao altere a senha
                 // nao aplicar o MD5 novamente.
                 if($dados['senha'] != $dados['senha_temp']){

                    $senha = md5($dados['senha']);

                 }else{

                    $senha = $dados['senha'];

                 }

                 // Aplicando as regras
                 // Caso algum campo nao esteja valido, será gerado um array com todos os erros
                 $errors = validateFields($dados, $rules);

                 // Se nao existir nenhum error seria inserido no banco 
                 if(count($errors) == 0){

                    // Dados para alteração conforme definimos na classe Database
                    $update = [
                      'codigo' => $codigo,
                      'nome' => $dados['nome'],
                      'email' => $dados['email'],
                      'senha' => $senha,
                    ];

                    // Caso seja alterado será enviado para a pagina principal com a mensagem de sucesso
                    if($db->update($update)){

                      // Variavel de sessão
                      $_SESSION['mensagem'] = "Usuario Alterado com sucesso!";

                    // Redireciona para a listagem de usuarios
                    header('Location: usuario.php');

                    }

                 }

                // Formas de validar campos antes de utilizar uma classe especifica para validação
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
              // Verifica se há erros de validacao
              if(count($errors) > 0 ):
              ?>


                <div class="alert alert-danger" role="alert">

                  <?php
                    // Se houver erros de validação, eles serão listados
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


              <form class="form-horizontal" method="post" autocomplete="off">

                <fieldset>
                  <legend>Alterar</legend>

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
                      <button type="submit" class="btn btn-primary">Alterar</button>
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
