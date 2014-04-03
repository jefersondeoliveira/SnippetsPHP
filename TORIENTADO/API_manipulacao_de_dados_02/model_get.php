<?php
//inclui o autoload
include_once 'app.ado/TAutoload.class.php';
include_once 'app.config/tabelas.class.config.php';

//recupera objetos no banco de dados
try
{
	//inicia transa��o com o banco 'mysql_config'
	TTransaction::open('mysql_config');
	//define o arquivo para LOG
	TTransaction::setLogger(new TLoggerTXT('tmp/log2.txt'));
	
	//exibe algumas mensagens na tela
	echo "obtendo alunos<br>\n";
	echo "==============<br>\n";
	
	//obt�m aluno de ID 1
	$aluno = new AlunoRecord(3);
	echo '    Nome:' . $aluno->nome     . "<br>\n";
	echo 'Endere�o:' . $aluno->endereco . "<br>\n";
	
	//obt�m aluno de ID 2
	$aluno = new AlunoRecord(4);
	echo '    Nome:' . $aluno->nome     . "<br>\n";
	echo 'Endere�o:' . $aluno->endereco . "<br>\n";
	
	//obt�m alguns cursos
	echo "<br>\n";
	echo "obtendo cursos<br>\n";
	echo "==============<br>\n";
	
	//obt�m curso de ID 1 
	$curso = new CursoRecord(1);
	echo 'Curso: ' . $curso->descricao ."<br>\n";
	
	//obt�m curso de ID 1 
	$curso = new CursoRecord(2);
	echo 'Curso: ' . $curso->descricao ."<br>\n";
	
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