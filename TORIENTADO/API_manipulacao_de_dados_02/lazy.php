<?php
//inclui o autoload
include_once 'app.ado/TAutoload.class.php';
include_once 'app.config/tabelas.class.config.php';

try
{
	//inicia transa��o com o banco 'mysql_config'
	TTransaction::open('mysql_config');
	//define o arquivo para LOG
	TTransaction::setLogger(new TLoggerTXT('tmp/log11.txt'));
	
	//armazena esta frase no arquivo de LOG
	TTransaction::log("** obtendo o aluno de uma inscri��o");
	
	//instancia a Inscri��o cujo ID � 2
	$inscricao = new InscricaoRecord(2);
	//exibe os dados relacionados de aluno (associa��o)
	echo "Dados da inscri��o<br>\n";
	echo "====================<br>\n";
	echo '    Nome :' . $inscricao->aluno->nome 	. "<br>\n";
	echo 'Endere�o :' . $inscricao->aluno->endereco . "<br>\n";
	echo '  Cidade :' . $inscricao->aluno->cidade 	. "<br>\n";
	
	//armazena esta frase no arquivo de LOG
	TTransaction::log("** obtendo as inscri��es de um aluno");
	
	//instancia o Aluno cujo ID � 2
	$aluno = new AlunoRecord(2);
	//exibe os dados relacionados de inscri��es (associa��o)
	echo "Inscri��es do Aluno<br>\n";
	echo "====================<br>\n";
	
	foreach ($aluno->inscricoes as $inscricao)
	{
		echo '    ID :' . $inscricao->id 		 . "<br>\n";
		echo ' Turma :' . $inscricao->ref_turma  . "<br>\n";
		echo '  Nota :' . $inscricao->nota 		 . "<br>\n";
		echo '  Frea :' . $inscricao->frequencia . "<br>\n";
		echo "<br>\n";
	}
		
	//finaliza a transa��o
	TTransaction::close();
	
}
catch (Exception $e)
{
	//exibe a mensagem gerada pela exce��o
	echo '<b>ERRO</b>'. $e->getMessage();
	//desfaz todas altera��es no banco de dados
	TTransaction::rollback();
}
?>