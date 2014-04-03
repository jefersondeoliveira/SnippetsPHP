<?PHP ob_start();

	$dir = dirname(__FILE__).'/arquivos/';
	
	$unzip = new ZipArchive();
	$unzip->open(getcwd().'/arquivos/arquivos.zip');
	echo $dir.'arquivos.zip';
	$unzip->extractTo($dir);
	$unzip->close();
	
	header('Location: index.php');

?>