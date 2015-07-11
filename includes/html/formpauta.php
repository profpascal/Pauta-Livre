<form method="POST" action ="../controller/ControllerPauta.php">
Titulo:<input type="text" name="titulo">
Detalhes:<input type="text" name="detalhes">
<select name="categoria">
	<option value="1">Palestra</option>
	<option value="2">Polemica</option>
	<option value="3">Outros</option>

</select>

<input type="hidden" name="acao" value="inserir">
<input type="submit">
</form>