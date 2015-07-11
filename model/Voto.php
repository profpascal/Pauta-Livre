<?php

	class Voto{

		private $id_pauta;
		private $id_usuario;

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