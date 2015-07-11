<?php
	require_once "../model/Pauta.php";
	require_once "ControllerConexao.php";

	class DaoPauta{
		private $conexao;
     
	    private function conectar(){
	        $ccon = new ControllerConexao();
	        $this->conexao = $ccon->pegarConexao();
	    }
	     
	    private function desconectar(){
	        $this->conexao = null;
	    }

	    public function inserir($pauta){
	    	try{
     			$this->conectar();

     			$stmt = $this->conexao->prepare("INSERT INTO ebc.tb_pauta (nm_titulo, nm_detalhes, id_usuario, ie_categoria, dt_envio) VALUES ( ?, ?, ?, ?, ?)");
	            $stmt->bindValue(1, strip_tags($pauta->getTitulo()));
	            $stmt->bindValue(2, strip_tags($pauta->getDetalhes()));
	            $stmt->bindValue(3, strip_tags($pauta->getId_usuario()));
				$stmt->bindValue(4, strip_tags($pauta->getCategoria()));
				$stmt->bindValue(5, strip_tags($pauta->getDt_envio()));

	            $resultado = $stmt->execute();
	             
	            $this->desconectar();
	           	return $resultado;

	        }catch (PDOException $ex){
	             
	            echo "Erro".$ex->getMessage();
	            return false;
	             
	        }
	    }

	    public function consultarPorId($id){
	        try{
	            $this->conectar();
	            $pauta = new Pauta();
	            $stmt = $this->conexao->prepare("Select * FROM ebc.tb_pauta where id_pauta = ?");

	            if ($stmt->execute(array($id))) {
					while ($row = $stmt->fetch()) {
		               
		                $pauta->setTitulo($row["nm_titulo"]);
		                $pauta->setId_usuario($row["id_usuario"]);
		                $pauta->setId_pauta($row["id_pauta"]);
		                $pauta->setDetalhes($row["nm_detalhes"]);
		                $pauta->setCategoria($row["ie_categoria"]);
		                $pauta->setDt_envio($row["dt_envio"]);
	            	}
	            }
	            $this->desconectar();
	            return $pauta;
	            
	        }catch(PDOException $ex){
	            echo "Erro:".$ex->getMessage();
	            return false;
	        }
   		}

   		public function consultarUltimasPautas(){
	        try{
	            $this->conectar();
	            $stmt = $this->conexao->query("Select * FROM ebc.tb_pauta order by dt_envio desc limit 10");
	            $vetPautas = null;
	            if ($stmt->execute(array())) {
					while ($row = $stmt->fetch()) {
		               	$pauta = new Pauta();
		                $pauta->setTitulo($row["nm_titulo"]);
		                $pauta->setId_usuario($row["id_usuario"]);
		                $pauta->setId_pauta($row["id_pauta"]);
		                $pauta->setDetalhes($row["nm_detalhes"]);
		                $pauta->setCategoria($row["ie_categoria"]);
		                $pauta->setDt_envio($row["dt_envio"]);
		                $vetPautas[] = $pauta;
	            	}
	            }
	            $this->desconectar();
	            return $vetPautas;
	        }catch(PDOException $ex){
	            echo "Erro:".$ex->getMessage();
	            return false;
	        }
   		}

   		public function consultarTop5(){
	        try{
	            $this->conectar();
	            $stmt = $this->conexao->query("Select id_pauta, count(id_usuario) as qtdvotos FROM ebc.tb_voto order by qtdvotos desc limit 5");
	            $vetPautas = null;
	            foreach ($stmt as $row) {
	            	$pauta =$this->consultarPorId($row["id_pauta"]);
	            	$vetPautas[] = $pauta;
	            }
	            $this->desconectar();
	            return $vetPautas;
	        }catch(PDOException $ex){
	            echo "Erro:".$ex->getMessage();
	            return false;
	        }
   		}

   		public function alterar($pauta){
   			try{

   				$this->conectar();

   				$stmt = $this->conexao->prepare("UPDATE ebc.tb_pauta set nm_titulo = ?, nm_descricao = ?, ie_categoria where id_pauta = ?");
   				$stmt->bindValue(1,strip_tags($pauta->getTitulo()));
   				$stmt->bindValue(2,strip_tags($pauta->getDescricao()));
   				$stmt->bindValue(3,strip_tags($pauta->getCategoria()));
   				$stmt->bindValue(4,$pauta->getId_pauta());

   				$resultado = $stmt->execute();
   				$this->desconectar();
   				return $resultado;

   			}catch(PDOException $ex){
   				echo "Erro: ".$ex->getMessage();
   				return false;
   			}
   		}

   		public function inativar($usuario){
   			//A fazer
   		}
	}



?>