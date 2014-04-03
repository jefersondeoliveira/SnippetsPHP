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
$criteria1 = new TCriteria;
//seleciona todas as meninas (F)
//que est�o na terceira (3) s�rie
$criteria1->add(new TFilter(' sexo ', '= ', 'F'));
$criteria1->add(new TFilter(' serie ', '= ', '3'));

//seleciona todos os meninos (M)
//que est�o na quarta (4) s�rie
$criteria2 = new TCriteria;
$criteria2->add(new TFilter(' sexo ', '= ', 'M'));
$criteria2->add(new TFilter(' serie ', '= ', '4'));

//agora juntamos os dois crit�rios utilizando
//o operador logico OR (ou). O resultado deve conter
//"meninas da 3a serie OU meninos da 4a serie"
$criteria = new TCriteria;
$criteria->add($criteria1, TExpression::OR_OPERATOR);
$criteria->add($criteria2, TExpression::OR_OPERATOR);
//define o ordenamento da consulta
$criteria->setProperty('order', 'nome');

//cria instru��o de SELECT
$sql = new TSqlSelect;
//define o nome da entidade
$sql->setEntity('aluno');
//acrescenta colunas � consulta
$sql->addColumn('*');
//define o crit�rio de sele��o de dados
$sql->setCriteria($criteria);

//processa a instru��o SQL
echo $sql->getInstruction();
echo "<br>\n";
?>