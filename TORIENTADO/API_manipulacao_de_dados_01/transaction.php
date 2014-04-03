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
	
	//cria uma instruчуo de INSERT
	$sql = new TSqlInsert;
	//define o nome da entidade
	$sql->setEntity('famosos');
	//atribui o valor de cada coluna
	$sql->setRowData('codigo', 4);
	$sql->setRowData('nome', Galileu);
	
	//obtщm a conexуo ativa
	$conn = TTransaction::get();
	//executa a instruчуo SQL
	$result = $conn->Query($sql->getInstruction());
	
	//cria uma instruчуo UPDATE
	$sql = new TSqlUpdate;
	//define o nome da entidade
	$sql->setEntity('famosos');
	//atribui o valor de cada coluna
	$sql->setRowData('nome','Galileu Galilei');
	
	//cria critщrio de seleчуo de dados
	$criteria = new TCriteria;
	//obtem a pesso ade codigo 4
	$criteria->add(new TFilter(' codigo' , '=', '3'));
	
	//atribui criterio de seleчуo de dados
	$sql->setCriteria($criteria);
	
	//obtem a conexao ativa
	$conn = TTransaction::get();
	//executa a instruчуo SQL
	$result = $conn->Query($sql->getInstruction());
	
	//fecha a transaчуo, aplicanto todas as operaчѕes
	TTransaction::close();
}
catch (Exception $e)
{
	//exibe a mensagem de erro
	echo $e->getMessage();
	//desfaz operaчѕes realizadas durante a transaчуo
	TTransaction::rollback();
}
?>