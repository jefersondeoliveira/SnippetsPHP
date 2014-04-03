<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Forçar Downloads</title>
<style type="text/css">
.d {
	color: #FFF;
}
.fdsfasd {
	color: #666;
}
</style>
</head>

<body>
<table width="465" border="0" cellpadding="5">
  <tr class="d">
    <td width="400" bgcolor="#666666">Arquivo</td>
    <td width="39" bgcolor="#666666">Baixar</td>
  </tr>
 
    <?php 
		foreach(glob("uploads/*.*") as $arquivo) // recuperando todos os arquivos dentro da pasta uploads em um array
		{
			$nome = basename($arquivo); //pegando apenas o nome do arquivo e iguinorando a pasta
			
			echo
			'
 <tr>
    <td bgcolor="#CCCCCC" class="fdsfasd">'.$nome.'</td>
    <td bgcolor="#CCCCCC"><a href="baixar.php?file='.$nome.'" ><img src="icoSave.png" title="Download do arquivo"/></a></td>
  </tr>
			';
		}
	?>
	</table>
</body>
</html>