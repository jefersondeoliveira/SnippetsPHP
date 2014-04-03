<?php
//inclui o autoload
include_once 'app.ado/TAutoload.class.php';
include_once 'app.config/tabelas.class.config.php';

//conta objetos do banco de dados
try
{
	//inicia transação com o banco 'mysql_config'
	TTransaction::open('mysql_config');
	//define o arquivo para LOG
	TTransaction::setLogger(new TLoggerTXT('tmp/log8.txt'));
	
	######################################################
	#primeiro exemplo, conta todos alunos de Porto Alegre#
	######################################################
	
	TTransaction::log("** Conta Alunos de Porto Alegre");
	
	//instancia critério de seleção de dados
	$criteria = new TCriteria;
	//filtra por turno e encerrada
	$criteria->add(new TFilter(' cidade ', '= ', 'Porto Alegre'));
	

	//instancia um repositório para Alunos
	$repository = new TRepository('Aluno');
	//retorna quantos objetos que satisfazem o critério
	$count = $repository->count($criteria);
	
	//exibe o total na tela
	echo "Total de alunos de Porto Alegre: {$count} <br><br>\n";
	
	##########################################################
	#segundo exemplo, Contar todas as turmas com aula na sala#
	#"100" no turno da Tarde OU na "200" pelo turno da manha #
	##########################################################
	
	TTransaction::log("** Conta Turmas");
	
	//instancia critério de seleção de dados
	//sala "100" e turno "T" (tarde)
	$criteria1 = new TCriteria;
	//filtra por turno e encerrada
	$criteria1->add(new TFilter(' sala ', '= ', '100'));
	$criteria1->add(new TFilter(' turno ', '= ', 'T'));
	
	//instancia critério de seleção de dados
	//sala "200" e turno "M" (manha)
	$criteria2 = new TCriteria;
	//filtra por turno e encerrada
	$criteria2->add(new TFilter(' sala ', '= ', '200'));
	$criteria2->add(new TFilter(' turno ', '= ', 'M'));
	
	//instancia critério de seleção de dados
	//com OU para juntar os critérios anteriores
	$criteria = new TCriteria;
	//filtra por turno e encerrada
	$criteria->add($criteria1, TExpression::OR_OPERATOR);
	$criteria->add($criteria2, TExpression::OR_OPERATOR);
	

	//instancia um repositório para Turmas
	$repository = new TRepository('Turma');
	//retorna quantos objetos que satisfazem o critério
	$count = $repository->count($criteria);
	
	//exibe o total na tela
	echo "Total de turmas: {$count} <br><br>\n";
	
	//finaliza a transação
	TTransaction::close();
}
catch (Exception $e) // em caso de exceção
{
	//exibe a mensagem gerada pela exceção
	echo '<b>ERRO</b>' . $e->getMessage();
	//desfaz todas alterações no banco de dados
	TTransaction::rollback();
}
?>