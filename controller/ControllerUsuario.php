<?php

	require_once "../dao/DaoUsuario.php";
	require_once "../dao/DaoVoto.php";
	require_once "../model/Voto.php";
	require_once "../model/Usuario.php";
	
	
	$usuario = new ControllerUsuario();
	
	class ControllerUsuario{ 
		function __construct(){
			if(isset($_POST["acao"])){
				$acao = $_POST["acao"];
			}else{
				$acao = $_GET["acao"];
			}
			
			if(isset($acao)){
				$this->processarAcao($acao);
			}else{
				echo"Nenhuma ação a ser processada.";
			}
		}

		public function processarAcao($acao){
			if($acao == "cadastrar"){
				$this->cadastrar();
			}else if($acao == "login"){
				$this->login();
			}else if($acao == "votar"){
				$this->votar();
			}
		}

		public function cadastrar(){//a terminar
			$usuario = new Usuario();
			$daoUsuario = new DaoUsuario();
			$senhabase = $_POST["senha"];
			$usuario->setNome($_POST["nome"]);
			$usuario->setEmail($_POST["email"]);
			$tmp = md5($_POST["email"]);
			$senha = md5($_POST["senha"].$tmp);
			var_dump($tmp);
			$usuario->setSenha($senha);

			$daoUsuario->inserir($usuario);

			$this->login2($usuario->getEmail(),$senhabase);
			//header("location: ../view/index.php");
		}

		public function login(){
			$email = $_POST["email"];
			$senha = $_POST["senha"];
			session_start();
			$tmp = md5($email);
			$senha = md5($senha.$tmp);
			$daoUsuario = new DaoUsuario();
			$usuario = $daoUsuario->consultarLogin($email,$senha);
			if ($usuario =! false){
				//login sucesso
				
				$_SESSION["id"] = $usuario->getId_usuario();
				$_SESSION["nome"] = $usuario->getNome();
				$_SESSION["usuario"] = $usuario;
				echo "Login Realizado com sucesso";
			}else{
				echo "Senha ou email incorretos";
			}
		}


		public function login2($email,$senha){//login local
			session_start();
			$tmp = md5($email);
			$senha = md5($senha.$tmp);
			$daoUsuario = new DaoUsuario();
			$usuario = $daoUsuario->consultarLogin($email,$senha);
			if (isset($usuario)){
				//login sucesso
				$_SESSION["id"] = $usuario->getId_usuario();
				$_SESSION["nome"] = $usuario->getNome();
				$_SESSION["usuario"] = $usuario;
			}else{
				echo "Senha ou email incorretos";
			}
		}

		public function votar(){
			$id_pauta = $_GET["id_pauta"];
			session_start();
			if (isset($_SESSION["usuario"])){
				$daoVoto = new DaoVoto();
				$usuario = $_SESSION["usuario"];
				if($daoVoto->consultarVoto($usuario->getId_usuario(), $id_pauta)){
					$daoVoto->cancelarVoto($usuario->getId_usuario(), $id_pauta);
					echo "desvotado";
				}else{
					$daoVoto->inserir($usuario->getId_usuario(), $id_pauta);
					echo "votado";
				}
			}else{
				echo "usuario nao esta logado";
			}
			header("location: ../view/ultimaspautas.php?acao=ultimaspautas");
		}


	}
?>
