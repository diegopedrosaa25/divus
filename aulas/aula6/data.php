<?php

$hostname = 'localhost';
$username = 'postgres';
$password = '';
$database = 'divus';


// Conexao com o banco
try {
	$dsn = "pgsql:host=$hostname;dbname=$database"; // mysql:
   	$dbh = new PDO($dsn, $username, $password);
   	echo 'Conectado ao banco de dados<br><br>';
}
catch(PDOException $e)
{
   echo $e->getMessage();
}


    
//Recuperar todos registros
// $sql = "SELECT * FROM setor";
// $sth = $dbh->prepare($sql);
// $sth->execute();

//  $rows = $sth->fetchAll();

// foreach($rows as $row){
//    echo "Codigo: " . $row['codigo'] . "<br>";
//    echo "Nome: " . $row['nome'] . "<br><br>";
// }




//Recuperar um registro
// $sql = "SELECT * FROM setor WHERE codigo=2";
// $sth = $dbh->prepare($sql);
// $sth->execute();

// $row = $sth->fetch();
// echo "Nome: " . $row['nome'] . "<br>";



// Insert/Deletar/Update
$sql = "DELETE FROM setor WHERE codigo = 1";
$count = $dbh->exec($sql);
if($count > 0)
   echo "Linhas deletadas: $count";

// Criar um script para inserir 50 setores
// Gerar no nome do setor uma string randomica
//INSERT INTO setor(nome) VALUES (?);

for ($i=0; $i < 50; $i++) { 
	
	$nome = "Teste" . $i;
	$sql = "INSERT INTO setor(nome) VALUES ($nome)";
	
	if($dbh->exec($sql))
	   echo "Linhas inserida com sucesso <br>";

}





//UPDATE usuario
//   SET email="teste@teste.com"
// WHERE codigo = 7;

$codigo = 1;
$ano = 2015;
$sql = 'SELECT * FROM setor WHERE codigo=:codigo and ano=:ano';
$s = $dbh->prepare($sql);
$s->bindParam(':codigo', $codigo);
$s->bindParam(':ano', $ano);

$s->bindValue(':codigo', 1);

$s->execute();
$row = $s->fetch();
echo $row['nome'] . $row['email'];


