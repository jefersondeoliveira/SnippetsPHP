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
$criteria->add(new TFilter(' nome ', 'like', 'maria%'));
$criteria->add(new TFilter(' cidade ', 'like', 'Porto%'));

//define intervalo de consulta
$criteria->setProperty('offset', 0);
$criteria->setProperty('limit', 10);
//define o ordenamento da consulta
$criteria->setProperty('order', 'nome');

//cria instru��o de SELECT
$sql = new TSqlSelect;
//define o nome da entidade
$sql->setEntity('aluno');
//acrescenta colunas � consulta
$sql->addColumn('nome');
$sql->addColumn('fone');
//define o crit�rio de sele��o de dados
$sql->setCriteria($criteria);

//processa a instru��o SQL
echo $sql->getInstruction();
echo "<br>\n";
?>