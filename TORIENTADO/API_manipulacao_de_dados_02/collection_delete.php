<?php
//inclui o autoload
include_once 'app.ado/TAutoload.class.php';
include_once 'app.config/tabelas.class.config.php';

//deleta objetos do banco de dados
try
{
	//inicia transa��o com o banco 'mysql_config'
	TTransaction::open('mysql_config');
	//define o arquivo para LOG
	TTransaction::setLogger(new TLoggerTXT('tmp/log9.txt'));
	
	##############################################################################
	#primeiro exemplo, exclui as turmas da tarde / /modo 1 EXECUTA VARIOS DELETES#
	##############################################################################
	
	TTransaction::log("** Exclui as turmas da tarde");
	
	//instancia crit�rio de sele��o turno = 'T'
	$criteria = new TCriteria;
	//filtra por turno e encerrada
	$criteria->add(new TFilter(' turno ', '= ', 'T'));
	

	//instancia um reposit�rio para Turmas
	$repository = new TRepository('Turma');
	//retorna quantos objetos que satisfazem o crit�rio
	$turmas = $repository->load($criteria);
	
	//verifica se retornou alguma turma
	if ($turmas)
	{
		//percorre todas turmas retornadas
		foreach ($turmas as $turma)
		{
			//exclui a turma
			$turma->delete();
		}
	}
	
	//exibe mensagem na tela
	echo "Turmas excluidas<br><br>\n";
	
	#########################################################################################
	#primeiro exemplo, exclui as inscri��es do aluno "1" / /modo 2 EXECUTA UM DELETES APENAS#
	#########################################################################################
	
	TTransaction::log("** Exclui as inscri��es do anulo '1'");
	
	//instancia crit�rio de sele��o de dados
	//sala "100" e turno "T" (tarde)
	$criteria = new TCriteria;
	//filtra por turno e encerrada
	$criteria->add(new TFilter(' ref_aluno ', '= ', 1));
		
	//instancia um reposit�rio de Inscri��o
	$repository = new TRepository('Inscricao');
	//exclui todos objetos que satisfa�am este crit�rio de sele��o
	$repository->delete($criteria);
	
	//exibe mensagem na tela
	echo "Turmas excluidas<br><br>\n";
	
	//finaliza a transa��o
	TTransaction::close();
}
catch (Exception $e) // em caso de exce��o
{
	//exibe a mensagem gerada pela exce��o
	echo '<b>ERRO</b>' . $e->getMessage();
	//desfaz todas altera��es no banco de dados
	TTransaction::rollback();
}
?>