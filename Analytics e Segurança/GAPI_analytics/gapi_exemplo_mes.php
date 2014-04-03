<?php
	require_once("gapi.class.php");

	// Autenticação
	$ga = new gapi('jefersonoliveira@hotmail.com.br', 'adminJeferson');

	// ID do perfil do site
	$id = '42252878';

	// Define o periodo do relatório
	$inicio = date('Y-m-01', strtotime('-1 month')); // 1° dia do mês passado
	$fim = date('Y-m-t', strtotime('-1 month')); // Último dia do mês passado

	// Busca os pageviews e visitas (total do mês passado)
	$ga->requestReportData($id, 'month', array('pageviews', 'visits'), null, null, $inicio, $fim);
	foreach ($ga->getResults() as $dados) {
		echo 'Mês ' . $dados . ': ' . $dados->getVisits() . ' Visita(s) e ' . $dados->getPageviews() . ' Pageview(s)<br />';
	}

	echo '<br />';

	// Busca os pageviews e visitas de cada dia do último mês
	$ga->requestReportData($id, 'day', array('pageviews', 'visits'), 'day', null, $inicio, $fim, 1, 50);
	foreach ($ga->getResults() as $dados) {
		echo 'Dia ' . $dados . ': ' . $dados->getVisits() . ' Visita(s) e ' . $dados->getPageviews() . ' Pageview(s)<br />';
	}
?>