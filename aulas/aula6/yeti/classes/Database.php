<?php
class Database {
    private $hostname = 'localhost';
    private $user = 'postgres';
    private $password = 'tralala';
    private $database = 'divus';
    private $db;
    private $tabela;
    
    public function __construct($tabela) {
        $this->tabela = $tabela;
        $this->connect();
    }
    
    public function __destruct(){
        $this->db = null;
    }
    
    private function connect(){
    
        try {
            $this->db = new PDO("pgsql:host=$this->hostname;dbname=$this->database", $this->user, $this->password);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        
    }
    
    public function queryAll(){

        $sql = "select * from " . $this->tabela . " order by codigo";

        $sth = $this->db->prepare($sql);
        $sth->execute();        
        return $sth->fetchAll();        
        
    }
    
    public function queryOne($codigo){
        
        $sql = "select * from " . $this->tabela . " where codigo = " . $codigo;
        $sth = $this->db->prepare($sql);
        $sth->execute();
        return $sth->fetch();       
        
    }    

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
