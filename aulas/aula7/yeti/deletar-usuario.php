<?php

// Classe de banco de dados
include "classes/Database.php";

// Classe de validação
include "classes/validation-2.3.3.php";

// Para utilizarmos a variavel de sessão é necessario executar este metodo.
session_start();

// Criação de uma instancia da classe de banco 
$db = new Database("usuario");

// Recuperando o codigo do usuario enviado via GET
$codigo = $_GET['codigo'];

// Deletando o usuario, caso seja deletado com sucesso será enviado para a pagina de listagem
if($db->delete($codigo)){
	$_SESSION['mensagem'] = "Usuario deletado com sucesso!";

	header('Location: usuario.php');
}
