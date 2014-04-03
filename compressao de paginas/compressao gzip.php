 <?php //VERIFICANDO SE O BROWSER ACEITA A COMPACTAÇÃO
 if( stripos ( $_SERVER [ 'HTTP_ACCEPT_ENCODING' ], 'gzip' ) !== false ) 
 { 
 ob_start ( 'ob_gzhandler' );  // SE SIM INICIA A COMPACTAÇÃO 
 } 
 else 
 { 
 ob_start (); // SE NÃO INICIA COM BUFFERING NORMAL
 } 
 ?>
 
 	<!--CONTEUDO SITE-->
 
 <?php 
 ob_end_flush (); 
 ?> 