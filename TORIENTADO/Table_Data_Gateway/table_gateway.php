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
	function insert($id, $descricao, $estoque, $preco_custo)
	{
		//cria instrução SQL de insert
		$sql = "INSERT INTO Produtos (id, descricao, estoque, preco_custo)" .
			   "VALUES ('$id', '$descricao', '$estoque', '$preco_custo')";
		
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
	function update($id, $descricao, $estoque, $preco_custo)
	{
		//cria instrução SQL de insert
		$sql = "UPDATE produtos SET descricao = '$descricao'," .
			   " estoque = '$estoque', preco_custo = '$preco_custo'" .
			   " WHERE id = '$id'";

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
		//---ERRO -->$data = $result->fetch(PDO::FETCH_ASSOC);
		unset($conn);
		return "OK";
	}
	
	/*
	 * método getObjects
	 *  busca um registro da tabela de produtos
	 *  @param $id = ID do produto
	 */
	function getObjects()
	{
		//cria instrução SQL de insert
		$sql = "SELECT * FROM produtos";
			   
		echo $sql . "<br>\n";
		//instancia objeto PDO
		$conn = new PDO('mysql:host=localhost;dbname=produtos', 'root', '');
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

		//executa instrução SQL
		$result = $conn->exec($sql);
		//---ERRO -->$data = $result->fetchAll(PDO::FETCH_ASSOC);
		unset($conn);
		return "OK";
	}
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////




//instancia objeto ProdutoGateway
$gateway = new ProdutoGateway;

//insere alguns registros na tabela
$gateway->insert(1, 'Vinho',  10, 10);
$gateway->insert(2, 'Salame', 20, 20);
$gateway->insert(3, 'Queijo', 30, 30);

//efetua algumas alterações
$gateway->update(1, 'Vinho',  20, 20);
$gateway->update(2, 'Salame', 40, 40);

//exclui o produto 3
$gateway->delete(3);

//exibe os produtos
echo "Lista de Produtos<br>\n";
print_r($gateway->getObjects());


?>