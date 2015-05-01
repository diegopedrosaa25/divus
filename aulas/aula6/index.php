<?php

include "classes/Database.php";

// $db = new Database("usuario");

// $senha = md5('123456');
// $dado = ['nome'=>'Chico', 'email'=>'chico@bento.com', 'senha'=>$senha];
// $n = $db->insert($dado);

// if($n > 0)
// 	echo "Usuario inserido com sucesso!";


// $db = new Database("setor");

// $dado = ['nome'=>'Deposito'];
// $n = $db->insert($dado);

// if($n > 0)
// 	echo "Setor inserido com sucesso!";

$db = new Database("setor");

$dado = ['codigo'=>6,'nome'=>'Deposito de cargas'];
$n = $db->update($dado);

if($n > 0)
	echo "Setor alterado com sucesso!";