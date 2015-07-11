<?php

	class Voto{
		private $id_comentario;
		private $id_pauta;
		private $id_usuario;
		private $comentario;

		public function getId_comentario(){
			return $this->id_comentario;
		}

		public function setId_comentario($id_comentario){
			$this->id_comentario = $id_comentario;
		}

		public function getComentario(){
			return $this->comentario;
		}

		public function setComentario($comentario){
			$comentario = $this->comentario;
		}

		public function getId_pauta(){
			return $this->id_pauta;
		}

		public function setId_pauta($id_pauta){
			$this->id_pauta = $id_pauta;
		}

		public function getId_usuario(){
			return $this->id_usuario;
		}

		public function setId_usuario($id_usuario){
			$this->id_usuario = $id_usuario;
		}

	}
?>