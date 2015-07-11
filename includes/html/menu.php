<?php
	session_start();
	if (isset($_SESSION["id"])){
		echo "O usuario: ". $_SESSION["nome"]." esta logado";
	}else{
		echo "Você ainda não está logado";
	}
?>
<ul>
	<li><a href="../view/index.php"> Cadastro</a> </li>
	<li><a href="../view/login.php"> Login</a></li>
	<li><a href="../view/pesquisa.php"> Pesquisa(nao implementado)</a></li>
	<li><a href="../view/top5.php?acao=top5"> Top 5</a></li>
	<li><a href="../view/ultimaspautas.php?acao=ultimaspautas"> Ultimas Pautas</a></li>
	<li><a href="../view/logout.php">Logout</a></li>
	<li><a href="../view/cadastrarpauta.php"> Cadastre sua pauta</a></li>
</ul>