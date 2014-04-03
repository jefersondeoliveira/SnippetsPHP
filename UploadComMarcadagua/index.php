<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Up - com marca D'agua</title>
</head>

<body>

<?php 
     
	 if(isset($_POST['upload'])){
		 
		 $pasta             = 'upload';
		 $permitido         = array('image/jpg', 'image/jpeg', 'image/pjpeg',);
		 
		 $img               = $_FILES['img'];
		 $tmp           = $img['tmp_name'];
		 $name              = $img['name'];
		 $type              = $img['type'];
		 
		 require('upload.php');	 
		 
		 
		 if(!empty($name) && in_array($type, $permitido)){
				
				$nome = 'nabaladapatos-'.md5(uniqid(rand(), true)).'.jpg';
				
				upload($tmp, $nome, 640, $pasta);
		
		
		
		 }else{
			
			echo "Tipo de arquivo invalido, tente enviar um JPG";
			 
		 }
		 

	 }

?>

<form name="upload" enctype="multipart/form-data" action="" method="post" >

   <input type="file" name="img"/>
   
   <input type="submit" name="upload" value="upload" />


</form>
</body>
</html>