<?php
class ControllerConexao{
	public $con = null;
	public $dbType = "mysql";
	public $host = "localhost";
	public $user = "root";
	public $senha = "";
	public $db = "pfc_forum";
	
	public function pegarConexao(){
		try{
			//realiza a conexão
			//padrao: new PDO("tipo_do_banco:host=ip_do_host;dbname=nome_da_base", "usuário", "senha");
			
			$this->con = new PDO($this->dbType.":host=".$this->host.";dbname=".$this->db, $this->user, $this->senha);
			return $this->con;
		}catch(PDOException $ex){
			echo "Erro: ".$ex->getMessage();
		}
	}
}
?>
