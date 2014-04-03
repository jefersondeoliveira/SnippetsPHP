<?php
/*
 * classe ProdutoGateway
 * implementa Table Data Gateway
 */
class ProdutoGateway
{
	
	/*
	 * método insert
	 *  insere dados na tabela de produtos
	 *  @param $id 			= ID do produto
	 *  @param $descricao 	= descrição do produto
	 *  @param $estoque		= estoque atual 
	 *  @param $preco_custo = preço de custo
	 */
	function insert(Produto $object)
	{
		//cria instrução SQL de insert
		$sql = "INSERT INTO Produtos (id, descricao, estoque, preco_custo)" .
			   "VALUES ('$object->id', '$object->descricao', '$object->estoque', '$object->preco_custo')";
		
		echo $sql . "<br>\n";
		//instancia objeto PDO
		$conn = new PDO('mysql:host=localhost;dbname=produtos', 'root', '');
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

		//executa instrução SQL
		$conn->exec($sql);
		unset($conn);
	}
	
	/*
	 * método update
	 *  altera os dados na tabela de Produtos
	 *  @param $id 			= ID do produto
	 *  @param $descricao 	= descrição do produto
	 *  @param $estoque		= estoque atual 
	 *  @param $preco_custo = preço de custo  
	 */
	function update(Produto $object)
	{
		//cria instrução SQL de insert
		$sql = "UPDATE produtos SET descricao = '$object->descricao'," .
			   " estoque = '$object->estoque', preco_custo = '$object->preco_custo'" .
			   " WHERE id = '$object->id'";

		echo $sql . "<br>\n";
		//instancia objeto PDO
		$conn = new PDO('mysql:host=localhost;dbname=produtos', 'root', '');
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

		//executa instrução SQL
		$conn->exec($sql);
		unset($conn);
	}
	
	/*
	 * método delete
	 *  deleta um registro na tabela de Podutos
	 *  @param $id = ID do produto
	 */
	
	function delete($id)
	{
		//cria instrução SQL de insert
		$sql = "DELETE FROM produtos WHERE id = '$id'";

		echo $sql . "<br>\n";
		//instancia objeto PDO
		$conn = new PDO('mysql:host=localhost;dbname=produtos', 'root', '');
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

		//executa instrução SQL
		$conn->exec($sql);
		unset($conn);
	}
	
	/*
	 * método getObject
	 *  busca um registro da tabela de produtos
	 *  @param $id = ID do produto
	 */
	function getObject($id)
	{
		//cria instrução SQL de insert
		$sql = "SELECT * FROM produtos WHERE id = '$id'";
			   

		echo $sql . "<br>\n";
		//instancia objeto PDO
		$conn = new PDO('mysql:host=localhost;dbname=produtos', 'root', '');
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

		//executa instrução SQL
		$result = $conn->exec($sql);
		//--DANDO ERRO ------>$data = $result->fetch(PDO::FETCH_ASSOC);
		unset($conn);
		return "OK";
	}
}

class Produto
{
	public $id;
	public $descricao;
	public $estoque;
	public $preco_custo;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////




//instancia objeto ProdutoGateway
$gateway = new ProdutoGateway;

$vinho = new Produto;
$vinho->id		 	= 1;
$vinho->descricao 	= 'Vinho';
$vinho->estoque 	= 10;
$vinho->preco_custo = 15;

//insere alguns registros na tabela
$gateway->insert($vinho);

//exibe o objeto de código 1
print_r($gateway->getObject(1));

$vinho->descricao = 'Vinho Cabernet';
//atualiza o objeto no banco de dados
$gateway->update($vinho);

//exibe o objeto de código 1
print_r($gateway->getObject(1));


?>