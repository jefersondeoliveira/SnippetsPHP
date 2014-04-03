<?php
/*
 * class Produto
 *  representa um Produto a ser vendido
 */
final class Produto
{
	private $descricao;   // descri��o do produto
	private $estoque;     // estoque atual
	private $preco_custo; // pre�o de custo
	
	/*
	 * m�todo construtor
	 *  define alguns valores iniciais
	 *  @param $descricao   = descri��o do produto
	 *  @param $estoque     = estoque atual
	 *  @param $preco_custo = pre�o de custo
	 */
	public function __construct($descricao, $estoque, $preco_custo)
	{
		$this->descricao = $descricao;
		$this->estoque   = $estoque;
		$this->preco_custo = $preco_custo;
	}
	
	/*
	 * m�todo registraCompra
	 *  registra uma compra, atualiza custo e incrementa o estoque atual
	 *  @param $unidades    = unidades adquiridas
	 *  @param $preco_custo = novo preco de custo
	 */
	public function registraCompra($unidades, $preco_custo)
	{
		$this->preco_custo = $preco_custo;
		$this->estoque    += $unidades;
	}
	
	/*
	 * m�todo registraVenda
	 *  registra uma venda e decrementa o estoque
	 *  @param $unidades  = unidades vendidas
	 */
	public function registraVenda($unidades)
	{
		$this->estoque -= $unidades;
	}
	
	/*
	 * m�todo getEstoque
	 *  retorna a quantidade em estoque
	 */
	public function getEstoque()
	{
		return $this->estoque;
	}
	
	/*
	 * m�todo calculaPrecoVenda
	 *  retorna o pre�o da venda, baseado em uma margem de 30% sobre o custo
	 */
	public function calculaPrecoVenda()
	{
		return $this->preco_custo*1.3;
	}
}

/*
 * classe Venda
 *  representa uma Venda de Produtos
 */
final class Venda
{
	private $itens; //itens da venda
	
	/*
	 * m�todo addItem
	 *  adiciona um item na venda
	 *  @param $quantidade = quantidade vendida
	 *  @param $produto    = objeto produto
	 */
	public function addItem($quantidade, Produto $produto)
	{
		$this->itens[] = array($quantidade, $produto);
	}
	
	/*
	 * m�todo getItens
	 *  retorna o array de itens da venda
	 */
	public function getItens()
	{
		return $this->itens;
	}
	
	/*
 	* m�todo finalizaVenda
 	*  calcula o total de uma cesta e diminui o estoque
 	*/
	public function finalizaVenda()
	{
		foreach ($this->itens as $item)
		{
			$quantidade = $item[0];
			$produto	= $item[1];
	
			//soma o total
			$total += $produto->calculaPrecoVenda() * $quantidade;
			//diminui estoque
			$produto->registraVenda($quantidade);
		}
		return $total;		
	}
}

//instancia objeto venda
$venda = new Venda;
//adiciona alguns produtos
$venda->addItem(3, new Produto('Vinho',  10, 15)); //58.5
$venda->addItem(2, new Produto('Salame', 20, 20)); //52
$venda->addItem(1, new Produto('Queijo', 30, 10)); //13

//finaliza venda
echo $venda->finalizaVenda();
?>