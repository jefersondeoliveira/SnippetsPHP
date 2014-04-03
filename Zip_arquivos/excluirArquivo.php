<?PHP ob_start();

	$dir = dirname(__FILE__).'/arquivos/';

	
	unlink($dir.$_GET['arquivo']);

	
	header('Location: index.php');

?>