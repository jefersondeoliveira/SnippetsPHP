<?php
if(isset($_GET['logar'])){
	$user = $_GET['usuario'];
	$senha = sha1($_GET['senha']);
	$senhaA = '40bd001563085fc35165329ea1ff5c5ecbdbbeef';

	
	
	if(($user == 'teste')AND($senha == $senhaA)){
		echo 'LOGADO senha: '.$senha;
	}else{
		echo 'Usuario e senha não conve';
	}

}

?>

<br/><br/><br/>
	<form>
		<label for="usuario"><strong>Usuario:</strong></label>
		<input type="text" name="usuario" value="" rel=""/><br/>
		<label for="senha"><strong>Senha:</strong></label>
		<input type="text" name="senha" value="" rel=""/>
		<input type="submit" name="logar" value="loagar"/>
	</form>