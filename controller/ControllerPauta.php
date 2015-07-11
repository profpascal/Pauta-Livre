<?php

	require_once "../dao/DaoPauta.php";
	require_once "../dao/DaoVoto.php";
	require_once "../model/Voto.php";
	require_once "../model/Pauta.php";
	require_once "../model/Usuario.php";
	
	
	$pauta = new ControllerPauta();
	
	class ControllerPauta{ 
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
			if($acao == "inserir"){
				$this->inserirPauta();
			}else if($acao == "excluir"){
				$this->excluir();
			}else if($acao == "alterar"){
				$this->alterar();
			}else if($acao == "ultimaspautas"){
				$this->ultimasPautas();
			}else if($acao == "top5"){
				$this->top5();
			}
		}

		public function inserirPauta(){
			session_start();
			if (isset($_SESSION["usuario"])){
				$daoPauta = new DaoPauta();
				$pauta = new Pauta();
				var_dump($_SESSION["usuario"]);
				$pauta->setTitulo($_POST["titulo"]);
				$pauta->setDetalhes($_POST["detalhes"]);
				$usuario = $_SESSION["usuario"];
				var_dump($usuario);
				$pauta->setId_usuario($usuario->getId_usuario());
				$pauta->setCategoria($_POST["categoria"]);
				$pauta->setDt_envio(date("Y-m-d H:i:s"));

				$daoPauta->inserir($pauta);

				echo "inserido com sucesso";
			}else{
				echo "usuario nao logado";
			}
		}

		public function frontpage(){//nao implementado ainda(nao mecher)
			$daoVoto = new DaoVoto();
			$daoPauta = new DaoPauta();
			$vetTop15pauta = null;
			$vetTop10id = $daoVoto->top10pautas();
			foreach ($vetTop10id as $id) {
				$pauta = $daoPauta->consutaPorId($id);
				$vetTop10pauta[] = $pauta;
			}

			$vetNew15pauta = null;
			$vetNew15id = $daoVoto->new15pautas();
			foreach ($vetNew15id as $id) {
				$pauta = $daoPauta->consutaPorId($id);
				$vetNew15pauta[] = $pauta;
			}

			$vetTop10WeekPauta = null;
			$vetTop10WeekId = $daoVoto->top10WeekPautas();
			foreach ($vetTop10WeekId as $id) {
				$pauta = $daoPauta->consutaPorId($id);
				$vetTop10WeekPauta[] = $pauta;
			}

			$vettop10DayPauta = null;
			$vettop10DayId = $daoVoto->top10DayPautas();
			foreach ($vettop10DayId as $id) {
				$pauta = $daoPauta->consutaPorId($id);
				$vettop10DayPauta[] = $pauta;
			}

			//dar um jeito de mandar pra tela
		}

		public function ultimasPautas(){
			$daoPauta = new DaoPauta();
			$vetPautas = $daoPauta->consultarUltimasPautas();
			echo "<h2> Ultimas Pautas </h2>";
			foreach ($vetPautas as $pauta) {
				$daoVoto= new DaoVoto();
				$qtd = $daoVoto->consultarPorPauta($pauta->getId_pauta());
				include "../includes/html/mostraPauta.php";
			}
		}

		public function top5(){
			$daoPauta = new DaoPauta();
			$vetPautas = $daoPauta->consultarTop5();
			echo "<h2> Top 5 pautas </h2>";
			foreach ($vetPautas as $pauta) {
				$daoVoto= new DaoVoto();
				$qtd = $daoVoto->consultarPorPauta($pauta->getId_pauta());
				include "../includes/html/mostraPauta.php";
			}
		}

	}
?>
