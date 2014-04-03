<?php
/*
 * classe Pessoa
 */
class Pessoa
{
	private $nome;     //nome da pessoa
	private $cidadeID; //ID da cidade
	
	/*
	 * m�todo construtor
	 *  instancia o objeto, define alguns atributos
	 *  @param $nome     = nome da pessoa
	 *  @param $cidadeID = c�digo da cidade
	 */
	function __construct($nome, $cidadeID)
	{
		$this->nome = $nome;
		$this->cidadeID = $cidadeID;
	}
	
	/*
	 * m�todo __get
	 *  intercepta a obten��o de propriedades
	 *  @param $propriedade = nome da propriedade
	 */
	function __get($propriedade)
	{
		if ($propriedade == 'cidade');
		{
			return new Cidade($this->cidadeID);
		}
	}
}

/*
 * classe cidade
 */
class Cidade
{
	private $id;   // id cidade
	private $nome; // nome da cidade
	
	/*
	 * m�todo construtor
	 *  instancia o objeto
	 *  @param $id = ID da cidade
	 */
	function __construct($id)
	{
		$data[1] = 'Porto Alegre';
		$data[2] = 'S�o Paulo';
		$data[3] = 'Rio de Janeiro';
		$data[4] = 'Belo Horizonte';
		
		//atribui o id
		$this->id = $id;
		
		//define seu nome
		$this->setNome($data[$id]);
	}
	
	/*
	 * m�todo setNome
	 *  define o nome da cidade
	 *  @param $nome = nome da cidade
	 */
	function setNome($nome)
	{
		$this->nome = $nome;
	}
	
	/*
	 * m�todo getNome
	 *  retorna o nome da cidade
	 */
	function getNome()
	{
		return $this->nome;
	}
}

//instancia dois objetos Pessoa
$maria = new Pessoa('Maria da Silva', 1);
$pedro = new Pessoa('Pedro Cardoso', 2);

//exibe o nome da cidade de cada Pessoa
echo $maria->cidade->getNome()."<br>\n";
echo $pedro->cidade->getNome()."<br>\n";

//exibe o atributo cidade
print_r($maria->cidade);

?>