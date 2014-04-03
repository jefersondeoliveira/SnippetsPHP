<?php
/*
 * fun��o __autoload()
 * Carrega uma classe quando ela � necess�ria,
 * ou seja, quando ela � instanciada pela primeira vez.
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
	//abre uma transa��o
	TTransaction::open('pg_livro');
	//define a estrat�gia de LOG
	TTransaction::setLogger(new TLoggerHTML('tmp/arquivo.html'));
	//escreve mensagem de LOG
	TTransaction::log("Inserindo registro Jeferson Oliveira");
	
	//cria uma instru��o INSERT
	$sql = new TSqlInsert;
	//define o nome da entidade
	$sql->setEntity('famosos');
	//atribui o valor de cada coluna
	$sql->setRowData('codigo','5');
	$sql->setRowData('nome','Jeferson Oliveira');
	
	//obtem a conex�o ativa
	$conn = TTransaction::get();
	//executa a instru��o SQL
	$result = $conn->Query($sql->getInstruction());
	//escreve mensgaem de LOG
	TTransaction::log($sql->getInstruction());
	
	//define a estrat�gia de LOG
	TTransaction::setLogger(new TLoggerXML('tmp/arquivo.xml'));
	
	//escreve mensagem de LOG
	TTransaction::log("Inserindo registro TESTE");
	
	//cria uma instru��o INSERT
	$sql = new TSqlInsert;
	//define o nome da entidade
	$sql->setEntity('famosos');
	//atribui o valor de cada coluna
	$sql->setRowData('codigo','6');
	$sql->setRowData('nome','TESTE');
	
	//obtem a conex�o ativa
	$conn = TTransaction::get();
	//executa a instru��o SQL
	$result = $conn->Query($sql->getInstruction());
	//escreve mensgaem de LOG
	TTransaction::log($sql->getInstruction());
	
	//fecha a transa��o, aplicando todas as opera��es
	TTransaction::close();
	
	echo"LOGs e inserts criados com sucesso";
}
catch (Exception $e)
{
	//exibe a mensagem de erro
	echo $e->getMessage();
	//desfaz opera��es realizadas durante transa��o
	TTransaction::rollback();
}
?>