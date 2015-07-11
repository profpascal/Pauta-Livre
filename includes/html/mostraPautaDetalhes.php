<div>
	<h2>Titulo: <?php echo $_SESSION["titulo"]; ?></h2><br>

	Detalhes: <?php echo $_SESSION["detalhes"]; ?><br>
	<br><br><br><br><br><br><br>
	Data de envio: <?php echo $_SESSION["dt_envio"]; ?><br>
	Quantidade de Votos <?php echo $_SESSION["qtd"];?><br>
	
	<a href="../controller/ControllerUsuario.php?acao=votar&id_pauta=<?php echo $_SESSION['id_pauta'];?>"><button>Aprovar</button></a>

	<?php
		$_SESSION["titulo"] = null;
		$_SESSION["detalhes"] = null;
		$_SESSION["dt_envio"] = null;
		$_SESSION["qtd"] = null;
		$_SESSION["id_pauta"] = null;

	?>
<div>
