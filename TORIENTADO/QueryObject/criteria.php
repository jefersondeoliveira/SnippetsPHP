<?php
//carrega as classes necessárias
include_once 'app.ado/TExpression.class.php';
include_once 'app.ado/TCriteria.class.php';
include_once 'app.ado/TFilter.class.php';

//aqui vemos um exemplo de critério ultilzando o operador lógico OR
//a idade deve ser menor que 16 OU maior que 60
$criteria = new TCriteria;
$criteria->add(new TFilter(' idade ', '< ', 16), TExpression::OR_OPERATOR);
$criteria->add(new TFilter(' idade ', '> ', 60), TExpression::OR_OPERATOR);
echo $criteria->dump();
echo "<br>\n";

//aqui vemos um exemplo de criterio utilizando o operador lógico AND
//juntamente com os operadores de conjunto IN (dentro do conjunto) e NOT IN (fora do conjunto)
//a idade deve estar dentro do conjunto (24,25,26) e deve estar fora do conjunto (10)
$criteria = new TCriteria;
$criteria->add(new TFilter(' idade ', 'IN ', array(24,25,26)));
$criteria->add(new TFilter(' idade ', 'NOT IN ', array(10)));
echo $criteria->dump();
echo "<br>\n";

//aqui vemos um exemplo de critério utilizando o operador de comparação LIKE
//o nome deve inciar por "pedro" OU deve iniciar por "maria"
$criteria = new TCriteria;
$criteria->add(new TFilter(' nome ', 'like ', 'pedro%'), TExpression::OR_OPERATOR);
$criteria->add(new TFilter(' nome ', 'like ', 'maria%'), TExpression::OR_OPERATOR);
echo $criteria->dump();
echo "<br>\n";

//aqui vemos um exemplo de critério utilizando os operadores "=" e IS NOT
//neste caso, o telefone não pode conter valor nulo (IS NOT NULL)
//e o sexo deve ser feminino (sexo = 'F')
$criteria = new TCriteria;
$criteria->add(new TFilter(' telefone ', 'IS NOT ', NULL));
$criteria->add(new TFilter(' sexo ', '= ', 'F'));
echo $criteria->dump();
echo "<br>\n";


?>