<?php
/*
 * função __autoload()
 * carrega uma classe quando ela é necessária, ou seja, quando ela é instanciada pela primeira vez
 */
function __autoload($classe)
{
	if (file_exists("app.ado/{$classe}.class.php"))
	{
		include_once "app.ado/{$classe}.class.php";
	}
}

//cria critério de seleção de dados
$criteria1 = new TCriteria;
//seleciona todas as meninas (F)
//que estão na terceira (3) série
$criteria1->add(new TFilter(' sexo ', '= ', 'F'));
$criteria1->add(new TFilter(' serie ', '= ', '3'));

//seleciona todos os meninos (M)
//que estão na quarta (4) série
$criteria2 = new TCriteria;
$criteria2->add(new TFilter(' sexo ', '= ', 'M'));
$criteria2->add(new TFilter(' serie ', '= ', '4'));

//agora juntamos os dois critérios utilizando
//o operador logico OR (ou). O resultado deve conter
//"meninas da 3a serie OU meninos da 4a serie"
$criteria = new TCriteria;
$criteria->add($criteria1, TExpression::OR_OPERATOR);
$criteria->add($criteria2, TExpression::OR_OPERATOR);
//define o ordenamento da consulta
$criteria->setProperty('order', 'nome');

//cria instrução de SELECT
$sql = new TSqlSelect;
//define o nome da entidade
$sql->setEntity('aluno');
//acrescenta colunas à consulta
$sql->addColumn('*');
//define o critério de seleção de dados
$sql->setCriteria($criteria);

//processa a instrução SQL
echo $sql->getInstruction();
echo "<br>\n";
?>