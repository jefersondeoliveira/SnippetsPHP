<?php
//inclui o autoload
include_once 'app.ado/TAutoload.class.php';
include_once 'app.config/tabelas.class.config.php';


//altera objetos no banco de dados
try
{
	//inicia transação com o banco 'mysql_config'
	TTransaction::open('mysql_config');
	//define o arquivo para LOG
	TTransaction::setLogger(new TLoggerTXT('tmp/log3.txt'));
	
	TTransaction::log("**obtendo o aluno 1");
	
	//instancia registro de Aluno
	$record = new AlunoRecord();
	
	//obtém o Aluno de ID 1
	$aluno = $record->load(3);
	
	if ($aluno) // verifica se ele existe
	{
		//altera o telefone
		$aluno->cidade = 'Patos de Minas';
		$aluno->telefone = '(52) 1111-2222';
		TTransaction::log("** persistindo o aluno 1");
		//armazena o objeto
		$aluno->store();
	}
	
	TTransaction::log("** obtendo o curso 1");
	
	//instanciando registro Curso
	$record = new CursoRecord;
	//obtem o Curso de ID 1
	$curso = $record->load(1);
	
	if ($curso) // verifica se ele existe
	{
		//altera a duração
		$curso->duracao = 28;
		TTransaction::log("** persistindo o curso 1");
		//armazena o objeto
		$curso->store();
	}
	
	//finaliza a transação
	TTransaction::close();
	//exibe mensagem de sucesso
	echo "Registros alterados com sucesso<br>\n";
	
}
catch (Exception $e)
{
	//exibe a mensagem gerada pela exceção
	echo '<b>ERRO</b>'. $e->getMessage();
	//desfaz todas alterações no banco de dados
	TTransaction::rollback();
}
?>