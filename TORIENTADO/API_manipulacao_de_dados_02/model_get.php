<?php
//inclui o autoload
include_once 'app.ado/TAutoload.class.php';
include_once 'app.config/tabelas.class.config.php';

//recupera objetos no banco de dados
try
{
	//inicia transação com o banco 'mysql_config'
	TTransaction::open('mysql_config');
	//define o arquivo para LOG
	TTransaction::setLogger(new TLoggerTXT('tmp/log2.txt'));
	
	//exibe algumas mensagens na tela
	echo "obtendo alunos<br>\n";
	echo "==============<br>\n";
	
	//obtém aluno de ID 1
	$aluno = new AlunoRecord(3);
	echo '    Nome:' . $aluno->nome     . "<br>\n";
	echo 'Endereço:' . $aluno->endereco . "<br>\n";
	
	//obtém aluno de ID 2
	$aluno = new AlunoRecord(4);
	echo '    Nome:' . $aluno->nome     . "<br>\n";
	echo 'Endereço:' . $aluno->endereco . "<br>\n";
	
	//obtém alguns cursos
	echo "<br>\n";
	echo "obtendo cursos<br>\n";
	echo "==============<br>\n";
	
	//obtém curso de ID 1 
	$curso = new CursoRecord(1);
	echo 'Curso: ' . $curso->descricao ."<br>\n";
	
	//obtém curso de ID 1 
	$curso = new CursoRecord(2);
	echo 'Curso: ' . $curso->descricao ."<br>\n";
	
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