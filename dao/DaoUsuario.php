<?php
	require_once "../model/Usuario.php";
	require_once "ControllerConexao.php";

	class DaoUsuario{
		private $conexao;
     
	    private function conectar(){
	        $ccon = new ControllerConexao();
	        $this->conexao = $ccon->pegarConexao();
	    }
	     
	    private function desconectar(){
	        $this->conexao = null;
	    }

	    public function inserir($usuario){
	    	try{
     			$this->conectar();
     			var_dump($usuario);
     			$stmt = $this->conexao->prepare("INSERT INTO ebc.tb_usuario (nm_usuario, nm_email, nm_senha) VALUES (?, ?, ?)");
	            $stmt->bindValue(1, $usuario->getNome());
	            $stmt->bindValue(2, $usuario->getEmail());
	            $stmt->bindValue(3, $usuario->getSenha());

	            $resultado = $stmt->execute();
	             
	            $this->desconectar();
	           	return $resultado;

	        }catch (PDOException $ex){
	             
	            echo "Erro".$ex->getMessage();
	            return "false";
	             
	        }
	    }

	    public function consultarPorId($id){
	        try{
	            $this->conectar();
	            $stmt = $this->conexao->query("SELECT * FROM ebc.tb_usuario where id_usuario = ?");

	            if ($stmt->execute(array($id))) {
					while ($row = $stmt->fetch()) {
		               	$usuario = new Usuario();
		                $usuario->setNome($row["nm_nome"]);
		                $usuario->setId_usuario($row["id_usuario"]);
		                $usuario->setEmail($row["nm_email"]);
	            	}
	            }
	            $this->desconectar();
	            if (isset($usuario)){
	            	return $usuario;
	            }else{
	            	return false;
	            }
	            
	        }catch(PDOException $ex){
	            echo "Erro:".$ex->getMessage();
	            return false;
	        }
   		}

   		public function consultarLogin($email,$senha){
   			try{
	            $this->conectar();
	            $stmt = $this->conexao->prepare("Select * FROM ebc.tb_usuario where nm_email = ? and nm_senha = ?");
	            $usuario = new Usuario();
	            if ($stmt->execute(array($email, $senha))) {
					while ($row = $stmt->fetch()) {
		               	var_dump($row);
		                $usuario->setNome($row["nm_usuario"]);
		                $usuario->setId_usuario($row["id_usuario"]);
		                $usuario->setEmail($row["nm_email"]);
	            	}
	            }
	            $this->desconectar();
	            var_dump($usuario);
	            if (isset($usuario)){
	            	var_dump($usuario);
	            	return $usuario;
	            
	            }else{
	            	return false;
	            }
	            
	        }catch(PDOException $ex){
	            echo "Erro:".$ex->getMessage();
	            return false;
	        }
   		}

   		public function alterar($usuario){
   			try{

   				$this->conectar();

   				$stmt = $this->conexao->prepare("UPDATE ebc.tb_usuario set nm_usuario = ?, nm_email = ? where id_usuario = ?");
   				$stmt->bindValue(1,strip_tags($usuario->getNome()));
   				$stmt->bindValue(2,strip_tags($usuario->getEmail()));
   				$stmt->bindValue(3,$usuario->getId_usuario());

   				$resultado = $stmt->execute();
   				$this->desconectar();
   				return $resultado;
   			}catch(PDOException $ex){
   				echo "Erro: ".$ex->getMessage();
   			}
   		}

   		public function trocarSenha($usuario){
   			//A fazer
   		}

   		public function inativar($usuario){
   			//A fazer
   		}
	}



?>