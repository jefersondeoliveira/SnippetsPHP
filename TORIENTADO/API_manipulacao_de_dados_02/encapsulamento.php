<?php
//inclui o autoload
include_once 'app.ado/TAutoload.class.php';
include_once 'app.config/tabelas.class.config.php';

//insere novos objetos no banco de dados
try
{
	//inicia transação com o banco 'mysql_config'
	TTransaction::open('mysql_config');
	//define o arquivo para LOG
	TTransaction::setLogger(new TLoggerTXT('tmp/log10.txt'));
	
	TTransaction::log("** Inserindo turma 1");
	
	//instancia um novo objeto turma
	$turma = new TurmaRecord;
	$turma->dia_semana 	= 1;
	$turma->turno 		= 'M';
	$turma->professor 	= 'Carlo Bellini';
	$turma->sala 		= '100';
	$turma->data_inicio = '2002-09-01';
	$turma->encerrada	= FALSE;
	$turma->ref_curso	= 2;
	$turma->store(); // armazena o objeto
	
	//instancia um novo objeto turma
	$turma = new TurmaRecord;
	$turma->dia_semana 	= 'Segunda';
	$turma->turno 		= 'Manha';
	$turma->professor 	= 'Sergio Crespo';
	$turma->sala 		= '200';
	$turma->data_inicio = '2002-09-01';
	$turma->encerrada	= FALSE;
	$turma->ref_curso	= 3;
	$turma->store(); // armazena o objeto
	
	//finaliza a transação
	TTransaction::close();
	echo "Registros inseridos com Sucesso<br>\n";
}
catch (Exception $e) // em caso de exceção
{
	//exibe a mensagem gerada pela exceção
	echo '<b>ERRO</b>' . $e->getMessage();
	//desfaz todas alterações no banco de dados
	TTransaction::rollback();
}
?>