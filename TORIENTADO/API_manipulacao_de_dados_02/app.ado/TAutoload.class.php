<?php
/*
 * funчуo __autoload()
 * Carrega uma classe quando ela щ necessсria,
 * ou seja, quando ela щ instanciada pela primeira vez.
 */
function __autoload($classe)
{
	if (file_exists("app.ado/{$classe}.class.php"))
	{
		include_once "app.ado/{$classe}.class.php";
	}
}
?>