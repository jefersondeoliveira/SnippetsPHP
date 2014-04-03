<?php
define('ga_email','jefersonoliveira@hotmail.com.br');
define('ga_password','adminJeferson');

require 'gapi.class.php';

$ga = new gapi(ga_email,ga_password);

$ga->requestAccountData();

foreach($ga->getResults() as $result)
{
  echo $result . ' (' . $result->getProfileId() . ")<br />";
}