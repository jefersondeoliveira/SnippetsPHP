<?php
/*
 * classe Produto
 *  representa um Produto a ser vendido
 */
final class Produto
{
	static $recordset = array();  // representa nossa estrutura de dados
	
	/*
	 * m�todo adicionar
	 *  adiciona um produto ao registro
	 *  @param $descricao 	= descri��o do produto
	 *  @param $estoque  	= estoque atual
	 *  @param $preco_custo = pre�o de custo
	 */
	public function adicionar($id, $descricao, $estoque, $preco_custo)
	{
		self::$recordset[$id]['descricao'] 	 = $descricao;
		self::$recordset[$id]['estoque'] 	 = $estoque;
		self::$recordset[$id]['preco_custo'] = $preco_custo;
	}
	
	/*
	 * m�todo registraCompra
	 *  registra uma compra, atualiza custo e incrementa o estoque atual do produto
	 *  @param $unidades 	= unidades adquiridas
	 *  @param $preco_custo = novo pre�o de custo
	 */
	public function registraCompra($id, $unidades, $preco_custo)
	{
		self::$recordset[$id]['preco_custo'] = $preco_custo;
		self::$recordset[$id]['estoque']    += $unidades;
	}
	
	/*
	 * m�todo registraVenda
	 *  registra uma venda e decrementa o estoque
	 *  @param $unidades = unidades vendidas
	 */
	public function registraVenda($id, $unidades)
	{
		self::$recordset[$id]['estoque'] -=$unidades;
	}
	
	/*
	 * m�todo getEstoque
	 *  retorna a quantidade em estoque
	 */
	public function getEstoque($id)
	{
		return self::$recordset[$id]['estoque'];
	}
	
	/*
	 * m�todo calculaPrecoVenda
	 *  retorna o pre�o de venda, baseando em uma margem de 30% sobre o custo
	 */
	public function calculaPrecoVenda($id)
	{
		return self::$recordset[$id]['preco_custo'] * 1.3;
	}
}	


//instancia objeto Produto
$produto = new Produto;

//adiciona alguns Produtos
$produto->adicionar(1, 'Vinho',  10, 15);
$produto->adicionar(2, 'Salame', 20, 20);

//exibe os estoques atuais
echo "estoques: <br>\n";
echo $produto->getEstoque(1). "<br>\n";
echo $produto->getEstoque(2). "<br>\n";

//exibe os pre�os de venda
echo "pre�os de venda: <br>\n";
echo $produto->calculaPrecoVenda(1). "<br>\n";
echo $produto->calculaPrecoVenda(2). "<br>\n";

//vende algumas unidades
$produto->registraVenda(1, 5);
$produto->registraVenda(2, 10);

//rep�e o estoque
$produto->registraCompra(1,  5, 16);
$produto->registraCompra(2, 10, 22);

//exibe os pre�os de venda atuais
echo "pre�os de venda: <br>\n";
echo $produto->calculaPrecoVenda(1). "<br>\n";
echo $produto->calculaPrecoVenda(2). "<br>\n";
?>