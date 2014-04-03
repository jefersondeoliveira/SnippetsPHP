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
	TTransaction::setLogger(new TLoggerTXT('tmp/log1.txt'));
	
	//armazena esta frase no arquivo LOG
	TTransaction::log("** inserindo alunos");
	
	//instanciando um novo objeto Aluno
	$daline = new AlunoRecord;
	$daline->nome     = 'Daline Dall Oglio';
	$daline->endereco = 'Rua da Conceição';
	$daline->telefone = '(51) 1111-2222';
	$daline->cidade   = 'Cruzeiro do Sul';
	$daline->store(); //armazena o objeto
	
	//instanciando um novo objeto Aluno
	$william = new AlunoRecord;
	$william->nome     = 'William Scatolla';
	$william->endereco = 'Rua de Fátima';
	$william->telefone = '(51) 1111-4444';
	$william->cidade   = 'Encantado';
	$william->store(); //armazena o objeto
	
	//armazena esta frase no arquivo LOG
	TTransaction::log("** inserindo cursos");
	
	//instanciando um novo objeto Curso
	$curso = new CursoRecord;
	$curso->descricao = 'Orientação a Objetos com PHP';
	$curso->duracao   = 24;
	$curso->store(); //armazena o objeto
	
	//instanciando um novo objeto Curso
	$curso = new CursoRecord;
	$curso->descricao = 'Desenvolvendo em PHP-GTK';
	$curso->duracao   = 32;
	$curso->store(); //armazena o objeto
	
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