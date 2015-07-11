<?php
	require_once "../model/Comentario.php";
	require_once "./ControllerConexao.php";

	class DaoComentario{
		private $conexao;
     
	    private function conectar(){
	        $ccon = new ControllerConexao();
	        $this->conexao = $ccon->pegarConexao();
	    }
	     
	    private function desconectar(){
	        $this->conexao = null;
	    }

	    public function inserir($comentario){
	    	try{
     			$this->conectar();

     			$stmt = $this->conexao->prepare("INSERT INTO ebc.tb_comentario (id_usuario, id_pauta, nm_comentario) VALUES (?, ?, ?)");
	            $stmt->bindValue(1, strip_tags($voto->getId_usuario()));
	            $stmt->bindValue(2, strip_tags($voto->getId_pauta()));
	            $stmt->bindValue(2, strip_tags($voto->getComentario()));

	            $resultado = $stmt->execute();
	             
	            $this->desconectar();
	           	return $resultado;

	        }catch (PDOException $ex){
	             
	            echo "Erro".$ex->getMessage();
	            return false;
	             
	        }
	    }

	    public function consultar($id_pauta){
	    	try{
	            $this->conectar();
	            $stmt = $this->conexao->query("Select * FROM ebc.tb_comentario where id_pauta = ?");
	            $vetComentario = null;
	            if ($stmt->execute(array($id_pauta))) {
					while ($row = $stmt->fetch()) {
		               	$comentario = new Comentario();
		               	$comentario->setId_comentario($row["id_comentario"]);
		               	$comentario->setId_pauta($row["id_pauta"]);
		               	$comentario->setId_usuario($row["id_usuario"]);
		               	$comentario->setComentario($row["nm_comentario"]);
		               	$vetComentario[] = $comentario;        	

	            	}
	            }
	            $this->desconectar();
	            if (isset($vetComentario){
	            	return $vetComentario;
	            }else{
	            	return false;
	            }
	            
	        }catch(PDOException $ex){
	            echo "Erro:".$ex->getMessage();
	            return false;
	        }
	    }

	    
	}



?>