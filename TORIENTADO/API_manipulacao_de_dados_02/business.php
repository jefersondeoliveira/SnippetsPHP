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
	TTransaction::setLogger(new TLoggerTXT('tmp/log12.txt'));
	
	//armazena esta frase no arquivo LOG
	TTransaction::log("** inserindo aluno \$carlos");
	
	//instanciando um novo objeto Aluno
	$carlos = new AlunoRecord;
	$carlos->nome     = 'Carlos Ranzi';
	$carlos->endereco = 'Rua Francisco Oscar';
	$carlos->telefone = '(51) 1234-5678';
	$carlos->cidade   = 'Lajeado';
	$carlos->store(); //armazena o objeto aluno
	
	
	
	//armazena esta frase no arquivo LOG
	TTransaction::log("** inscrevendo o aluno nas turmas");
	
	//executa o método Inscrever (na turma 1 e 2)
	$carlos->Inscrever(1);
	$carlos->Inscrever(2);
	
	//finaliza a transação
	TTransaction::close();
	echo "Registros inseridos com Sucesso<br>\n";
}
catch (Exception $e)
{
	//exibe a mensagem gerada pela exceção
	echo '<b>ERRO</b>'. $e->getMessage();
	//desfaz todas alterações no banco de dados
	TTransaction::rollback();
}

?>