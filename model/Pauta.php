<?php
	class Pauta{

		private $id_pauta;
		private $id_usuario;
		private $titulo;
		private $detalhes;
		private $categoria;
		private $dt_envio;
		private $dt_final;

		public function getDt_envio(){
			return $this->dt_envio;
		}

		public function setDt_envio($dt_envio){
			$this->dt_envio = $dt_envio;
		}

		public function getDt_final(){
			return $this->dt_final;
		}

		public function setDt_final($dt_final){
			$this->dt_final = $dt_final;
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

		public function getTitulo(){
			return $this->titulo;
		}

		public function setTitulo($titulo){
			$this->titulo = $titulo;
		}

		public function getDetalhes(){
			return $this->detalhes;
		}

		public function setDetalhes($detalhes){
			$this->detalhes = $detalhes;
		}

		public function getCategoria(){
			return $this->categoria;
		}

		public function setCategoria($categoria){
			$this->categoria = $categoria;
		}


	}
?>