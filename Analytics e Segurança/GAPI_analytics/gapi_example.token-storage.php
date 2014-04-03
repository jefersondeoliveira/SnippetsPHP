<?php
define('ga_email','jefersonoliveira@hotmail.com.br');
define('ga_password','adminJeferson');

require 'gapi.class.php';

$ga = new gapi(ga_email,ga_password,isset($_SESSION['ga_auth_token'])?$_SESSION['ga_auth_token']:null);
$_SESSION['ga_auth_token'] = $ga->getAuthToken();

echo 'Token: ' . $_SESSION['ga_auth_token'];
?>