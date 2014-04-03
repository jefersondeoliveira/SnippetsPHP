<?php
/*
 * fun��o __autoload()
 * Carrega uma classe quando ela � necess�ria,
 * ou seja, quando ela � instanciada pela primeira vez.
 */
function __autoload($classe)
{
	if (file_exists("app.ado/{$classe}.class.php"))
	{
		include_once "app.ado/{$classe}.class.php";
	}
}
?>