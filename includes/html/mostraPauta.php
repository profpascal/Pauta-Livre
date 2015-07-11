<div>
	Titulo: <?php echo $pauta->getTitulo(); ?><br>
	Detalhes: <?php echo $pauta->getDetalhes(); ?><br>
	Data de envio: <?php echo $pauta->getDt_envio(); ?><br>
	Quantidade de Votos <?php echo $qtd;?><br>
	<?php
		
		$_SESSION["titulo"] = $pauta->getTitulo();
		$_SESSION["detalhes"] = $pauta->getTitulo();
		$_SESSION["dt_envio"] = $pauta->getTitulo();
		$_SESSION["qtd"] = $qtd;
		$_SESSION["id_pauta"] = $pauta->getId_pauta();
	?>
	<a href="../controller/ControllerUsuario.php?acao=votar&id_pauta=<?php echo $pauta->getId_pauta();?>"><button>Aprovar</button></a> <a href="../view/detalhes.php"><button>Ver Detalhes</button></a>
<div>
<hr>
<br