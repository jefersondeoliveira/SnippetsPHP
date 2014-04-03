<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Compactar e Descompactar</title>
</head>

<body>

<?php
if(!extension_loaded('zip'))
{
	echo'A extenção php_zip não esta ativa no php.ini';
}else{
	echo'<a href="compactar.php">Zipar</a></br>';
	echo'<a href="extrair.php">Extrair</a>';
}
?>






</br></br>
Lista de arquivos:</br></br>
<?php 
// O CODIGO ABAIXO APENAS MOSTRA OS ARQUIVOS DA PASTA

		foreach(glob("arquivos/*.*") as $arquivo) // recuperando todos os arquivos dentro da pasta uploads em um array
		{
			$nome = basename($arquivo); //pegando apenas o nome do arquivo e iguinorando a pasta
			
			echo"$nome <a href=\"excluirArquivo.php?arquivo=$nome\">x</a> </br>";
		}
	?>
</body>
</html>