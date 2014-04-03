<?php
/*
 * classe TConnection
 * gerencia conex�es com bancos de dados atrav�s de arquivos de configura��o
 */
final class TConnection
{
	/*
	 * m�todo __construct()
	 *  n�o existir�o inst�ncias de TConnection, por isto estamos marcando-o como private
	 */
	private function __construct()
	{
		
	}
	
	/*
	 * m�todo open()
	 *  recebe o nome do banco de dados e instancia o objeto PDO correspondente
	 */
	public static function open($name)
	{
		//verifica se existe arquivo de configura��o para este banco de dados
		if (file_exists("app.config/{$name}.ini"))
		{
			//l� o INI e retorna um array
			$db = parse_ini_file("app.config/{$name}.ini");
		}
		else
		{
			//se n�o existir, lan�a um erro
			throw new Exception("Arquivo '$name' n�o encontrado");
		}
		
		//l� as informa��es contidas no arquivo
		$user = $db['user'];
		$pass = $db['pass'];
		$name = $db['name'];
		$host = $db['host'];
		$type = $db['type'];
		
		//descobre qual o tipo (drive) de banco de dados a ser utilizado
		switch ($type)
		{
			case 'pgsql':
				$conn = new PDO("pgsql:dbname={$name}; user={$user}; password={$pass}; host={$host}");
				break;
				
			case 'mysql':
				$conn = new PDO("mysql:host={$host};dbname={$name}", $user, $pass);
				break;
				
			case 'sqlite':
				$conn = new PDO("sqlite:{$name}");
				break;
				
			case 'ibase':
				$conn = new PDO("firebird:dbname={$name}", $user, $pass);
				break;
				
			case 'oci8':
				$conn = new PDO("oci:dbname={$name}", $user, $pass);
				break;	

			case 'mssql':
				$conn = new PDO("mssql:host={$host}; 1433; dbname={$name}", $user, $pass);
				break;	
		}
		
		//define para que o PDO lance exce��es na ocorr�ncia de erros
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		//retorna o objeto instanciado
		return $conn;
	}
}
?>