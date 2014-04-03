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

//cria instru��o de SELECT
$sql = new TSqlSelect;
//define o nome da entidade
$sql->setEntity('famosos');
//acrescenta colunas a consulta
$sql->addColumn('codigo');
$sql->addColumn('nome');
//cria criterio de sele��o de dados
$criteria = new TCriteria;
//condi��o
$criteria->add(new TFilter(' codigo ', '=', '2'));
//atribui o crit�rio de sele��o de dados
$sql->setCriteria($criteria);

try
{
	//abre conexao com a base no configconn.ini
	$conn = TConnection::open('pg_livro');
	
	//executa a instru��o SQL
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
	//fecha conex�o
	$conn = NULL;
}
catch (PDOException $e)
{
	//exibe a mensagem de erro
	print "ERRO!: " . $e->getMessage() . "<br />";
	die();
}
?>