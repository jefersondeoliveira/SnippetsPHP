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
	TTransaction::setLogger(new TLoggerTXT('tmp/log6.txt'));
	
	######################################################################
	# primeiro exemplo, lista todas as turmas em andamento no turno Tarde#
	######################################################################

	//cria um critério de seleção
	$criteria = new TCriteria;
	//filtra por turno e encerrada
	$criteria->add(new TFilter(' turno ',     '= ', 'T'));
	$criteria->add(new TFilter(' encerrada ', '= ', FALSE));

	//instancia um repositório para Turma
	$repository = new TRepository('Turma');
	//retorna todos objetos que satisfazem o critério
	$turmas = $repository->load($criteria);
	
	//verifica se retornou alguma turma
	if($turmas)
	{
		echo "Turmas retornadas <br>\n";
		echo "================= <br>\n";
		//percorre todas turmas retornadas
		foreach ($turmas as $turma)
		{
			echo '       ID :' . $turma->id 		. "<br>\n";
			echo '      Dia :' . $turma->dia_semana . "<br>\n";
			echo '     Sala :' . $turma->sala		. "<br>\n";
			echo '	  Turno :' . $turma->turno		. "<br>\n";
			echo 'Professor :' . $turma->professor	. "<br>\n";
			echo "<br><br>\n";
		}
	}
	
	######################################################
	# segundo exemplo, lista todos aprovados da turma "1"#
	######################################################
	
	//cria um critério de seleção
	$criteria = new TCriteria;
	//filtra por turno e encerrada
	$criteria->add(new TFilter(' nota ',       '>= ', 7));
	$criteria->add(new TFilter(' frequencia ', '>= ', 75));
	$criteria->add(new TFilter(' ref_turma ',   '= ', 1));
	$criteria->add(new TFilter(' cancelada ',   '= ', FALSE));
	
	//instancia um repositorio para Inscricao
	$repository = new TRepository('Inscricao');
	//retorna todos objetos que satisfazem o criterio
	$inscricoes = $repository->load($criteria);
	
	//verifica se retornou alguma inscrição
	if ($inscricoes)
	{
		echo "Inscrições retornadas <br>\n";
		echo "===================== <br>\n";
		
		//percorre todas inscrições retornadas
		foreach ($inscricoes as $inscricao)
		{
			echo '   ID :' . $inscricao->id        . "<br>\n";
			echo 'Aluno :' . $inscricao->ref_aluno . "<br>\n";
			
			//obtem o aluno relacionado a inscrição
			$aluno = new AlunoRecord($inscricao->ref_aluno);
			echo ' Nome :' . $aluno->nome     . "<br>\n";
			echo '  Rua :' . $aluno->endereco . "<br>\n";
			echo "<br><br>\n";
		}
	}
	
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