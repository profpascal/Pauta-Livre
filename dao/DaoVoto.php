<?php
	require_once "../model/Voto.php";
	require_once "ControllerConexao.php";

	class DaoVoto{
		private $conexao;
     
	    private function conectar(){
	        $ccon = new ControllerConexao();
	        $this->conexao = $ccon->pegarConexao();
	    }
	     
	    private function desconectar(){
	        $this->conexao = null;
	    }

	    public function inserir($id_usuario, $id_pauta){
	    	try{
     			$this->conectar();

     			$stmt = $this->conexao->prepare("INSERT INTO ebc.tb_voto (id_usuario, id_pauta) VALUES (?, ?)");
	            $stmt->bindValue(1, strip_tags($id_usuario));
	            $stmt->bindValue(2, strip_tags($id_pauta));

	            $resultado = $stmt->execute();
	             
	            $this->desconectar();
	           	return $resultado;

	        }catch (PDOException $ex){
	             
	            echo "Erro".$ex->getMessage();
	            return false;
	             
	        }
	    }

	    public function consultarPorPauta($id){
	        try{
	            $this->conectar();
	            $stmt = $this->conexao->prepare("Select count(id_usuario) as qtd FROM ebc.tb_voto where id_pauta = ?");

	            if ($stmt->execute(array($id))) {
					while ($row = $stmt->fetch()) {
		               	$qtd = $row["qtd"];
	            	}
	            }
	            $this->desconectar();
	            if (isset($qtd)){
	            	return $qtd;
	            }else{
	            	return false;
	            }
	            
	        }catch(PDOException $ex){
	            echo "Erro:".$ex->getMessage();
	            return false;
	        }
   		}

   		public function consultarPorUsuario($id){
	        try{
	            $this->conectar();
	            $stmt = $this->conexao->query("Select count(id_pauta) as qtd FROM ebc.tb_voto where id_usuario = ?");

	            if ($stmt->execute(array($id))) {
					while ($row = $stmt->fetch()) {
		               	$qtd = $row["qtd"];
	            	}
	            }
	            $this->desconectar();
	            if (isset($qtd)){
	            	return $qtd;
	            }else{
	            	return false;
	            }
	            
	        }catch(PDOException $ex){
	            echo "Erro:".$ex->getMessage();
	            return false;
	        }
   		}

   		public function consultarVoto($id_usuario,$id_pauta){
	        try{
	            $this->conectar();
	            $stmt = $this->conexao->prepare("Select count(id_pauta) as qtd FROM ebc.tb_voto where id_usuario = ? and id_pauta = ?");

	            if ($stmt->execute(array($id_usuario, $id_pauta))) {
					while ($row = $stmt->fetch()) {
		               	$qtd = $row["qtd"];
	            	}
	            }
	            $this->desconectar();
	            if ($qtd != 0){
	            	return true;
	            }else{
	            	return false;
	            }
	            
	        }catch(PDOException $ex){
	            echo "Erro:".$ex->getMessage();
	            return false;
	        }
   		}

   		public function cancelarVoto($id_usuario, $id_pauta){
   			try{
   				$this->conectar();
				$stmt = $this->conexao->prepare(" DELETE from ebc.tb_voto where id_usuario = ? and id_pauta = ?");

   				$stmt->bindValue(1,$id_usuario);
   				$stmt->bindValue(2,$id_pauta);
				$qt = $stmt->execute();
				$this -> desconectar();
				return $qt;
			}catch(PDOException $ex){
				echo "Erro: ".$ex->getMessage();
				return false;
			}

   		}
	}



?>