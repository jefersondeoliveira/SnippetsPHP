<?PHP ob_start();

	$dir = dirname(__FILE__).'/arquivos/';
	
	$zip = new ZipArchive();
	$zip->open($dir.'arquivos.zip', ZipArchive::CREATE);
	
	
	foreach(glob("arquivos/*.*") as $arquivo) // recuperando todos os arquivos dentro da pasta uploads em um array
		{
			$nome = basename($arquivo); //pegando apenas o nome do arquivo e iguinorando a pasta
			
			$zip->addFile($dir.$nome,$nome);
		}
		
	$zip->close();
	
	header('Location: index.php')

?>