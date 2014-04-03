<?php
//inclui o autoload
include_once 'app.ado/TAutoload.class.php';
include_once 'app.config/tabelas.class.config.php';

//obt�m objetos do banco de dados
try
{
	//inicia transa��o com o banco 'mysql_config'
	TTransaction::open('mysql_config');
	//define o arquivo para LOG
	TTransaction::setLogger(new TLoggerTXT('tmp/log7.txt'));
	TTransaction::log("** seleciona inscri��es da turma 2");
	
	//instancia crit�rio de sele��o de dados
	//seleciona todas inscri��es da turma "2"
	$criteria = new TCriteria;
	//filtra por turno e encerrada
	$criteria->add(new TFilter(' ref_turma ', '= ', 2));
	$criteria->add(new TFilter(' cancelada ', '= ', FALSE));

	//instancia um reposit�rio para Inscri��o
	$repository = new TRepository('Inscricao');
	//retorna todos objetos que satisfazem o crit�rio
	$inscricoes = $repository->load($criteria);
	
	//verifica se retornou alguma inscri��o
	if ($inscricoes)
	{
		TTransaction::log("** altera as inscri��es");
		
		//percorre todas inscri��es retornadas
		foreach ($inscricoes as $inscricao)
		{
			//altera algumas propriedades
			$inscricao->nota       = 8;
			$inscricao->frequencia = 75;
			
			//armazena o objeto no banco de dados
			$inscricao->store();
		}
	}
	
	//finaliza a transa��o
	TTransaction::close();
	echo "Altera��es efetuadas com sucesso";
}
catch (Exception $e) // em caso de exce��o
{
	//exibe a mensagem gerada pela exce��o
	echo '<b>ERRO</b>' . $e->getMessage();
	//desfaz todas altera��es no banco de dados
	TTransaction::rollback();
}
?>