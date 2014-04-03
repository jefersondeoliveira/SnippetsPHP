<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload Multiplo UPLOADIFY</title>
    <link href="uploadify/uploadify.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="uploadify/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="uploadify/swfobject.js"></script>
    <script type="text/javascript" src="uploadify/jquery.uploadify.v2.1.4.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      $('#file_upload').uploadify({
        'uploader'  : 'uploadify/uploadify.swf',
        'script'    : 'uploadify/uploadify.php',
        'cancelImg' : 'uploadify/cancel.png',	 //Imagem do botao Cancelar
        'folder'    : 'uploads/img', 			 //Pasta destino
		'buttonText': 'BUSCAR FOTOS', 	     //Texto do botao
		'fileExt'   : '*.jpg;*.gif;*.png',	     //Permissao de arquivos
		//'buttonImg'   : 'uploadify/button.jpg' //mudar Botao do select
		'sizeLimit' : 300000,					 //Tamanho Limite
		'height'    : 30,					     //Tamanho botao altura
		'width'     : 120,						 //Tamanho botao largura
		'multi'		: true,						 //Abilitar Multiplo upload
        'auto'      : true					 //Abilitar Upload Auto
		//'onAllComplete' : function(event,data)
			//{
     		// alert(data.filesUploaded + ' files uploaded successfully!');
    		//}
		
      });
    });
    </script>

</head>

<body>
		
        <form name="upload" action="" method="post">
       	    <input id="file_upload" name="file_upload" type="file" />
            <!--<a href="javascript:$('#file_upload').uploadifyUpload();">Fazer Uploads</a>-->
        </form>
		
</body>
</html>