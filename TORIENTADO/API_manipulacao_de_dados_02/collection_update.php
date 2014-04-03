<?php
//inclui o autoload
include_once 'app.ado/TAutoload.class.php';
include_once 'app.config/tabelas.class.config.php';

//obtém objetos do banco de dados
try
{
	//inicia transação com o banco 'mysql_config'
	TTransaction::open('mysql_config');
	//define o arquivo para LOG
	TTransaction::setLogger(new TLoggerTXT('tmp/log7.txt'));
	TTransaction::log("** seleciona inscrições da turma 2");
	
	//instancia critério de seleção de dados
	//seleciona todas inscrições da turma "2"
	$criteria = new TCriteria;
	//filtra por turno e encerrada
	$criteria->add(new TFilter(' ref_turma ', '= ', 2));
	$criteria->add(new TFilter(' cancelada ', '= ', FALSE));

	//instancia um repositório para Inscrição
	$repository = new TRepository('Inscricao');
	//retorna todos objetos que satisfazem o critério
	$inscricoes = $repository->load($criteria);
	
	//verifica se retornou alguma inscrição
	if ($inscricoes)
	{
		TTransaction::log("** altera as inscrições");
		
		//percorre todas inscrições retornadas
		foreach ($inscricoes as $inscricao)
		{
			//altera algumas propriedades
			$inscricao->nota       = 8;
			$inscricao->frequencia = 75;
			
			//armazena o objeto no banco de dados
			$inscricao->store();
		}
	}
	
	//finaliza a transação
	TTransaction::close();
	echo "Alterações efetuadas com sucesso";
}
catch (Exception $e) // em caso de exceção
{
	//exibe a mensagem gerada pela exceção
	echo '<b>ERRO</b>' . $e->getMessage();
	//desfaz todas alterações no banco de dados
	TTransaction::rollback();
}
?>