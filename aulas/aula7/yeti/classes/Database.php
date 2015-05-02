<?php
class Database {
    private $hostname = 'localhost';
    private $user = 'postgres';
    private $password = 'senha';
    private $database = 'divus';
    private $db;
    private $tabela;
    
    // Metodo construtor, recebe como parametro o nome da tabela
    public function __construct($tabela) {
        $this->tabela = $tabela;
        $this->connect();
    }
    
    // Metodo destruct que finaliza a conexão com o banco
    public function __destruct(){
        $this->db = null;
    }
    
    // Metodo utilizado para criar a conexao com o banco
    // ele e invocado no metodo construtor e cria a conexao $this->db
    private function connect(){
    
        try {
            $this->db = new PDO("pgsql:host=$this->hostname;dbname=$this->database", $this->user, $this->password);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        
    }

    // Metodo utilizado para recuperar todos dados de uma tabela especifica, ordenando por codigo
    // Retorna um array com todos dados da tabela especificada
    public function queryAll(){

        $sql = "select * from " . $this->tabela . " order by codigo";

        $sth = $this->db->prepare($sql);
        $sth->execute();        
        return $sth->fetchAll();        
        
    }
    
    // Metodo utilizado para recuperar uma linha de dado de uma tabela
    // Recebe um codigo inteiro
    // Retorna um array com os dados
    public function queryOne($codigo){
        
        $sql = "select * from " . $this->tabela . " where codigo = " . $codigo;
        $sth = $this->db->prepare($sql);
        $sth->execute();
        return $sth->fetch();       
        
    }    

    // Metodo utilizado para deletar uma linha especifica de uma tabela a partir do codigo
    // Recebe um codigo inteiro
    // Retorna um inteiro caso a inserção seja realizada com sucesso
    public function delete($codigo){
        
        $sql = "delete from " . $this->tabela . " where codigo = " . $codigo;
        return $this->db->exec($sql);       
        
    } 

    // Metodo utilizado para inserir dados em uma tabela
    // Recebe um array de dados com os campos
    // Retorna um inteiro caso a inserção seja realizada com sucesso
    public function insert($dado){

        $campo = "";
        $valor = "";
        foreach($dado as $key => $value){
            $campo .= "$key,";
            $valor .= "'$value',";
        }

        $campo = substr($campo, 0, -1);
        $valor = substr($valor, 0, -1);

        //// INSERT INTO setor(nome,email,senha) VALUES ('$nome', '$email', '$senha')
        $sql =  "INSERT INTO ".$this->tabela."($campo) VALUES ($valor)";
    
        return $this->db->exec($sql);
    }
    

    // Metodo utilizado para alterar dados em uma tabela
    // Recebe um array de dados com os campos
    // Retorna um inteiro caso a alteração seja realizada com sucesso
    public function update($dado){

        $campo = "";
        $condicao = "codigo=".$dado['codigo'];
        foreach($dado as $key => $value){
            $campo .= "$key='$value',";
        }

        $campo = substr($campo, 0, -1);

        //UPDATE usuario SET nome=?, email=?, senha=? WHERE codigo=?;
        $sql =  "UPDATE ".$this->tabela." SET $campo WHERE $condicao";
        return $this->db->exec($sql);
    }
}
