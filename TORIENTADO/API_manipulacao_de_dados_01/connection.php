<?php
/*
 * função __autoload()
 * Carrega uma classe quando ela é necessária,
 * ou seja, quando ela é instanciada pela primeira vez.
 */
function __autoload($classe)
{
	if (file_exists("app.ado/{$classe}.class.php"))
	{
		include_once "app.ado/{$classe}.class.php";
	}
}

//cria instrução de SELECT
$sql = new TSqlSelect;
//define o nome da entidade
$sql->setEntity('famosos');
//acrescenta colunas a consulta
$sql->addColumn('codigo');
$sql->addColumn('nome');
//cria criterio de seleção de dados
$criteria = new TCriteria;
//condição
$criteria->add(new TFilter(' codigo ', '=', '2'));
//atribui o critério de seleção de dados
$sql->setCriteria($criteria);

try
{
	//abre conexao com a base no configconn.ini
	$conn = TConnection::open('pg_livro');
	
	//executa a instrução SQL
	$result = $conn->query($sql->getInstruction());
	echo $sql->getInstruction();
			
	if ($result)
	{
		while($row = $result->fetch(PDO::FETCH_ASSOC))
		{
		//exibe os dados resultantes
		echo $row['codigo'] . ' - ' . $row['nome'] . "\n";
		}
	}
	//fecha conexão
	$conn = NULL;
}
catch (PDOException $e)
{
	//exibe a mensagem de erro
	print "ERRO!: " . $e->getMessage() . "<br />";
	die();
}
?>