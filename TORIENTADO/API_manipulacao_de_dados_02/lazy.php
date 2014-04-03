<?php
//inclui o autoload
include_once 'app.ado/TAutoload.class.php';
include_once 'app.config/tabelas.class.config.php';

try
{
	//inicia transação com o banco 'mysql_config'
	TTransaction::open('mysql_config');
	//define o arquivo para LOG
	TTransaction::setLogger(new TLoggerTXT('tmp/log11.txt'));
	
	//armazena esta frase no arquivo de LOG
	TTransaction::log("** obtendo o aluno de uma inscrição");
	
	//instancia a Inscrição cujo ID é 2
	$inscricao = new InscricaoRecord(2);
	//exibe os dados relacionados de aluno (associação)
	echo "Dados da inscrição<br>\n";
	echo "====================<br>\n";
	echo '    Nome :' . $inscricao->aluno->nome 	. "<br>\n";
	echo 'Endereço :' . $inscricao->aluno->endereco . "<br>\n";
	echo '  Cidade :' . $inscricao->aluno->cidade 	. "<br>\n";
	
	//armazena esta frase no arquivo de LOG
	TTransaction::log("** obtendo as inscrições de um aluno");
	
	//instancia o Aluno cujo ID é 2
	$aluno = new AlunoRecord(2);
	//exibe os dados relacionados de inscrições (associação)
	echo "Inscrições do Aluno<br>\n";
	echo "====================<br>\n";
	
	foreach ($aluno->inscricoes as $inscricao)
	{
		echo '    ID :' . $inscricao->id 		 . "<br>\n";
		echo ' Turma :' . $inscricao->ref_turma  . "<br>\n";
		echo '  Nota :' . $inscricao->nota 		 . "<br>\n";
		echo '  Frea :' . $inscricao->frequencia . "<br>\n";
		echo "<br>\n";
	}
		
	//finaliza a transação
	TTransaction::close();
	
}
catch (Exception $e)
{
	//exibe a mensagem gerada pela exceção
	echo '<b>ERRO</b>'. $e->getMessage();
	//desfaz todas alterações no banco de dados
	TTransaction::rollback();
}
?>