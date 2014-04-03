<?php
/*
 * classe TLogger
 * Esta classe prov� uma interface abstrata para defini��o de algoritimos de LOG
 */
abstract class TLogger
{
	protected $filename; // local do arquivo de LOG
	
	/*
	 * m�todo __construct()
	 *  instancia um logger
	 *  @param $filename = local do arquivo de LOG
	 */
	public function __construct($filename)
	{
		$this->filename = $filename;
		//reseta o conte�do do arquivo
		file_put_contents($filename, '');
	}
	
	//define o m�todo write como obrigatorio
	abstract function write($message);
}
?>