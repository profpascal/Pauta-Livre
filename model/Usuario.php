<?php

	class Usuario{

		private $id_usuario;
		private $nome;
		private $email;
		private $senha;
		private $votos_diarios;

		public function getId_usuario(){
			return $this->id_usuario;
		}

		public function setId_usuario($id_usuario){
			$this->id_usuario = $id_usuario;
		}

		public function getNome(){
			return $this->nome;
		}

		public function setNome($nome){
			$this->nome = $nome;
		}

		public function getEmail(){
			return $this->email;
		}

		public function setEmail($email){
			$this->email = $email;
		}

		public function getSenha(){
			return $this->senha;
		}

		public function setSenha($senha){
			$this->senha = $senha;
		}

		public function getVotos_diarios(){
			return $this->votos_diarios;
		}

		public function setVotos_diarios($votos_diarios){
			$this->votos_diarios = $votos_diarios;
		}

	}
?>