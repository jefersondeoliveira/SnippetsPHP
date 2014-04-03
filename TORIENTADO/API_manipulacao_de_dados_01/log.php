<?php
/*
 * funчуo __autoload()
 * Carrega uma classe quando ela щ necessсria,
 * ou seja, quando ela щ instanciada pela primeira vez.
 */
function __autoload($classe)
{
	if (file_exists("app.ado/{$classe}.class.php"))
	{
		include_once "app.ado/{$classe}.class.php";
	}
}

try
{
	//abre uma transaчуo
	TTransaction::open('pg_livro');
	//define a estratщgia de LOG
	TTransaction::setLogger(new TLoggerHTML('tmp/arquivo.html'));
	//escreve mensagem de LOG
	TTransaction::log("Inserindo registro Jeferson Oliveira");
	
	//cria uma instruчуo INSERT
	$sql = new TSqlInsert;
	//define o nome da entidade
	$sql->setEntity('famosos');
	//atribui o valor de cada coluna
	$sql->setRowData('codigo','5');
	$sql->setRowData('nome','Jeferson Oliveira');
	
	//obtem a conexуo ativa
	$conn = TTransaction::get();
	//executa a instruчуo SQL
	$result = $conn->Query($sql->getInstruction());
	//escreve mensgaem de LOG
	TTransaction::log($sql->getInstruction());
	
	//define a estratщgia de LOG
	TTransaction::setLogger(new TLoggerXML('tmp/arquivo.xml'));
	
	//escreve mensagem de LOG
	TTransaction::log("Inserindo registro TESTE");
	
	//cria uma instruчуo INSERT
	$sql = new TSqlInsert;
	//define o nome da entidade
	$sql->setEntity('famosos');
	//atribui o valor de cada coluna
	$sql->setRowData('codigo','6');
	$sql->setRowData('nome','TESTE');
	
	//obtem a conexуo ativa
	$conn = TTransaction::get();
	//executa a instruчуo SQL
	$result = $conn->Query($sql->getInstruction());
	//escreve mensgaem de LOG
	TTransaction::log($sql->getInstruction());
	
	//fecha a transaчуo, aplicando todas as operaчѕes
	TTransaction::close();
	
	echo"LOGs e inserts criados com sucesso";
}
catch (Exception $e)
{
	//exibe a mensagem de erro
	echo $e->getMessage();
	//desfaz operaчѕes realizadas durante transaчуo
	TTransaction::rollback();
}
?>