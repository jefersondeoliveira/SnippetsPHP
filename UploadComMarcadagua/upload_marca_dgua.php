<?php function upload($tmp, $nome, $largura, $pasta){

        $img = imagecreatefromjpeg($tmp);
		
		$x = imagesx($img);
		$y = imagesy($img);
				
		$altura = ($largura*$y)/$x;
		$nova = imagecreatetruecolor($largura, $altura);
		
		imagecopyresampled($nova, $img, 0, 0, 0, 0, $largura, $altura, $x, $y);
		imagedestroy($img);
		$logo = imagecreatefrompng('logo.png');
		$logox = imagesx($logo);
		$logoy = imagesy($logo);
		
		$localx = $largura - 212;
		
		imagecopyresampled($nova, $logo, $localx, 0, 0, 0, 212, 59, $logox, $logoy);
		
		imagejpeg($nova, "$pasta/$nome");
		imagedestroy($nova);
				
		return($nome);




}?>