<?php
//conexao com bd

//$conexao = mysql_connect("localhost","root","");
//$bancodb = mysql_select_db("uploadmultiplo");

if (!empty($_FILES)) {
	$nome		= $_FILES['Filedata']['name'];
	$ext  		= substr($nome, -4);
	$nome		= md5($nome).date("dmYhis").$ext;
	
	$tempFile   = $_FILES['Filedata']['tmp_name'];
	
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
	
	$targetFile =  str_replace('//','/',$targetPath) . $nome;
	
	$largura = '640';

			
		//Upload
			$img = imagecreatefromjpeg($tempFile);
		
		$x = imagesx($img);
		$y = imagesy($img);
				
		$altura = ($largura*$y)/$x;
		$nova = imagecreatetruecolor($largura, $altura);
		
		imagecopyresampled($nova, $img, 0, 0, 0, 0, $largura, $altura, $x, $y);
		imagedestroy($img);
		$logo = imagecreatefrompng('logo_para_fotos.png');
		$logox = imagesx($logo);
		$logoy = imagesy($logo);
		
		$localx = $largura - 212;
		$localy = $altura - 59;
		
		imagecopyresampled($nova, $logo, $localx, $localy, 0, 0, 212, 59, $logox, $logoy);
		
		imagejpeg($nova, $targetFile);
		imagedestroy($nova);
	
	
	
		echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
		
		//Fim upload
		
		
		
		//Cadastro
		//$cadastro = mysql_query("INSERT INTO fotos (foto) VALUES ('$nome')")  
						//or die(mysql_error());


}
?>