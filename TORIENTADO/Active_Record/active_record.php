<?php
/*
 * classe ProdutoGateway
 * implementa Row Data Gateway
 */
class ProdutoGateway
{
	private $data;
	
	function __get($prop)
	{
		return $this->data[$prop];
	}
	
	function __set($prop, $value)
	{
		return $this->data[$prop] = $value;
	}
	
	/*
	 * método insert
	 *  armazena o objeto na tabela de produtos
	 */
	function insert()
	{
		//cria instrução SQL de insert
		$sql = "INSERT INTO Produtos (id, descricao, estoque, preco_custo)" .
			   "VALUES ('{$this->id}', '{$this->descricao}', '{$this->estoque}', '{$this->preco_custo}')";
		
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
	 */
	function update()
	{
		//cria instrução SQL de insert
		$sql = "UPDATE produtos SET descricao = '{$this->descricao}'," .
			   " estoque = '{$this->estoque}', preco_custo = '{$this->preco_custo}'" .
			   " WHERE id = '{$this->id}'";

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
	
	function delete()
	{
		//cria instrução SQL de insert
		$sql = "DELETE FROM produtos WHERE id = '{$this->id}'";
			   

		echo $sql . "<br>\n";
		//instancia objeto PDO
		$conn = new PDO('mysql:host=localhost;dbname=produtos', 'root', '');
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

		//executa instrução SQL
		$conn->exec($sql);
		unset($conn);
	}
	
	/*
	 * método registraCompra()
	 *  registra uma compra, atualiza custo e incrementa o estoque atual
	 *  @param $unidade		= unidades adquiridas
	 *  @param $preco_custo = novo preco de custo
	 */
	public function registraCompra($unidades, $preco_custo)
	{
		$this->preco_custo = $preco_custo;
		$this->estoque    += $unidades;
	}
	
	/*
	 * método registraVenda()
	 *  registra uma venda e decrementa o estoque
	 *  @param $unidade		= unidades adquiridas
	 */
	public function registraVenda($unidades)
	{
		$this->estoque    += $unidades;
	}
	
	/*
	 * método calculaPrecoVenda
	 *  retorna o preco de venda, baseado em uma margem de 30% de lucro
	 */
	public function calculaPrecoVenda()
	{
		return $this->preco_custo*1.3;
	}
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//instancia objeto produto
$vinho = new ProdutoGateway;
$vinho->id		 	= 1;
$vinho->descricao	= 'Vinho Cabernet';
$vinho->estoque 	= 10;
$vinho->preco_custo = 10;
$vinho->insert();

$vinho->registraVenda(5);
echo '    estoque: ' . $vinho->estoque . "<br>\n";
echo 'preco_custo: ' . $vinho->preco_custo . "<br>\n";
echo 'preco_venda: ' . $vinho->calculaPrecoVenda() . "<br>\n";

$vinho->registraCompra(10, 20);
$vinho->update();
echo '    estoque: ' . $vinho->estoque . "<br>\n";
echo 'preco_custo: ' . $vinho->preco_custo . "<br>\n";
echo 'preco_venda: ' . $vinho->calculaPrecoVenda() . "<br>\n";


?>