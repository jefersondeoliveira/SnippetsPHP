<?php
//inclui o autoload
include_once 'app.ado/TAutoload.class.php';
include_once 'app.config/tabelas.class.config.php';


//instancia objeto Aluno
$fabio = new AlunoRecord;
//define algumas propriedades
$fabio->nome = 'Fábio Locatelli';
$fabio->endereco = 'Rua Merlin';
$fabio->telefone = '(51) 222-1111';
$fabio->cidade   = 'Lajeado';

//clona o objeto $fabio
$julia = clone $fabio;

//altera algumas propriedades
$julia->nome = 'Júlia Haubert';
$julia->telefone = '(51) 2222-2222';

try
{
	//inicia transação com o banco 'mysql_config'
	TTransaction::open('mysql_config');
	//define o arquivo para LOG
	TTransaction::setLogger(new TLoggerTXT('tmp/log4.txt'));
	
	//armazena o objeto $fabio
	TTransaction::log("** persistindo o aluno \$fabio");
	$fabio->store();
	
	//armazena o objeto $julia
	TTransaction::log("** persistindo o aluno \$julia");
	$julia->store();
	
	//finaliza a transação
	TTransaction::close();
	//exibe mensagem de sucesso
	echo "clonagem realizada com sucesso<br>\n";
	
}
catch (Exception $e)
{
	//exibe a mensagem gerada pela exceção
	echo '<b>ERRO</b>'. $e->getMessage();
	//desfaz todas alterações no banco de dados
	TTransaction::rollback();
}

?>