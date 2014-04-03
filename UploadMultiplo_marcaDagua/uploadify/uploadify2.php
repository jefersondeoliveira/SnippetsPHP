<?php
//conexao com bd

$conexao = mysql_connect("localhost","root","");
$bancodb = mysql_select_db("uploadmultiplo");

if (!empty($_FILES)) {
	$img		= $_FILES['Filedata']['name'];
	$ext  		= substr($img, -4);
	$img		= md5($img).date("dmYhis").$ext;
	
	$tempFile   = $_FILES['Filedata']['tmp_name'];
	
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
	
	$targetFile =  str_replace('//','/',$targetPath) . $img;

		$cadastro = mysql_query("INSERT INTO fotos (foto) VALUES ('$img')")
						or die(mysql_error());
		
		move_uploaded_file($tempFile,$targetFile);
		echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);


}
?>