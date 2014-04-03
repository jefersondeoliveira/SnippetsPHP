<?php
//inclui o autoload
include_once 'app.ado/TAutoload.class.php';
include_once 'app.config/tabelas.class.config.php';

//exclui objetos da base de dados
try
{
	//inicia transa��o com o banco 'mysql_config'
	TTransaction::open('mysql_config');
	//define o arquivo para LOG
	TTransaction::setLogger(new TLoggerTXT('tmp/log5.txt'));
	
	//armazena esta frase no arquivo de LOG
	TTransaction::log("** Apagando da primeira forma");
		
	//carregando o objeto
	$aluno = new AlunoRecord(1);
	//delete o objeto
	$aluno->delete();
	
	//armazena esta frase no arquivo de LOG
	TTransaction::log("** apagando da segunda forma");
	
	//instanciando o modelo
	$modelo = new AlunoRecord();
	//delete o objeto
	$modelo->delete(2);
	
	//finaliza a transa��o
	TTransaction::close();
	//exibe mensagem de sucesso
	echo "Exclus�o realizada com sucesso<br>\n";
	
}
catch (Exception $e)
{
	//exibe a mensagem gerada pela exce��o
	echo '<b>ERRO</b>'. $e->getMessage();
	//desfaz todas altera��es no banco de dados
	TTransaction::rollback();
}

?>