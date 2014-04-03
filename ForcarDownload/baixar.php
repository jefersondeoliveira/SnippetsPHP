<?php
	
	$pasta = 'uploads';
	
	if(isset($_GET['file']) && file_exists("{$pasta}/".$_GET['file']))
	{
		$arquivo = $_GET['file'];
		$tipo	 = filetype("{$pasta}/{$arquivo}");
		$tamanho = filesize("{$pasta}/{$arquivo}");
		
		header("Content-Description: File Transfer");
		header("Content-Type:{$tipo}");
		header("Content-Length:{$tamanho}");
		header("Content-Disposition: attachment; filename=$arquivo");
		readfile("{$pasta}/{$arquivo}");
		exit;
	}

?>