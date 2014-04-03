<?php
/*
 * classe TLogger
 * Esta classe provъ uma interface abstrata para definiчуo de algoritimos de LOG
 */
abstract class TLogger
{
	protected $filename; // local do arquivo de LOG
	
	/*
	 * mщtodo __construct()
	 *  instancia um logger
	 *  @param $filename = local do arquivo de LOG
	 */
	public function __construct($filename)
	{
		$this->filename = $filename;
		//reseta o conteњdo do arquivo
		file_put_contents($filename, '');
	}
	
	//define o mщtodo write como obrigatorio
	abstract function write($message);
}
?>