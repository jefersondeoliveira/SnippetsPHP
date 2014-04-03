<?php

// Inclui o arquivo do PHPIDS
require_once 'IDS/Init.php';
$request = array(
        'REQUEST' => $_REQUEST,
        'GET' => $_GET,
        'POST' => $_POST,
        'COOKIE' => $_COOKIE
    );
// Inicia o PHPIDS
$init = IDS_Init::init('IDS/Config/Config.ini');
$ids = new IDS_Monitor($request, $init);
$result = $ids->run();

if (!$result->isEmpty()) {
// Exibe resultados caso sejam encontrados
echo $result;
} else {
        echo '<a href="?test=%22><script>eval(window.name)</script>">No attack detected - click for an example attack</a>';
    }

?>