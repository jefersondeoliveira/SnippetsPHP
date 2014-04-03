<?php
/*
 * fun��o __autoload()
 * carrega uma classe quando ela � necess�ria, ou seja, quando ela � instanciada pela primeira vez
 */
function __autoload($classe)
{
	if (file_exists("app.ado/{$classe}.class.php"))
	{
		include_once "app.ado/{$classe}.class.php";
	}
}

//cria crit�rio de sele��o de dados
$criteria = new TCriteria;
$criteria->add(new TFilter(' id ', '= ', '3'));

//cria instru��o DELETE
$sql = new TSqlDelete;
//define a entidade
$sql->setEntity('aluno');
//define criterio de sele��o de dados
$sql->setCriteria($criteria);

//processa a instru��o SQL
echo $sql->getInstruction();
echo "<br>\n";
?>