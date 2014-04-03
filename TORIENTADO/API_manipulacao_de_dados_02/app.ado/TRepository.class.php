<?php
/*
 * classe TRepository
 *  esta classe provê os métodos necessários para manipular coleções de objetos.
 */
final class TRepository
{
	private $class;  // nome da classe manipulada pelo repositório
	
	/*
	 * método construtor
	 *  instancia um Repositório de objetos
	 *  @param $class = Classe dos Objetos
	 */
	function __construct($class)
	{
		$this->class = $class;
	}
	
	/*
	 * método load()
	 *  Recupera um conjunto de objetos (collection) da base de dados
	 *  através de um criterio de seleção, e instanciá-los em memória
	 *  @param $criteria = objeto do tipo TCriteria
	 */
	function load(TCriteria $criteria)
	{
		//instancia a instrução de SELECT
		$sql = new TSqlSelect;
		$sql->addColumn('*');
		$sql->setEntity($this->class);
		//atribui o critério passado como parâmetro
		$sql->setCriteria($criteria);
		
		//obtem transação ativa
		if ($conn = TTransaction::get())
		{
			//registra a mensagem de LOG
			TTransaction::log($sql->getInstruction());
			
			//executa a consulta no banco de dados
			$result = $conn->Query($sql->getInstruction());
			
			if ($result)
			{
				//percorre os resultados da consulta, retornando um objeto
				while ($row = $result->fetchObject($this->class . 'Record'))
				{
					//armazena no array $results;
					$results[] = $row;
				}
			}
			return $results;
		}
		else 
		{
			//se não tiver transação, retorna uma execeção
			throw new Exception('Não há transação ativa');
		}
	}
	
	/*
	 * método delete()
	 *  Exclui um conjunto de objetos(collection) da base de dados
	 *  através de um critério de seleção
	 *  @param $criteria = objeto do tipo TCriteria
	 */
	function delete(TCriteria $criteria)
	{
		//instancia instrução de DELETE
		$sql = new TSqlDelete;
		$sql->setEntity($this->class);
		//atribui o criterio passado como pârametro
		$sql->setCriteria($criteria);
		
		//obtém transação ativa
		if ($conn = TTransaction::get())
		{
			//registra mensagem de LOG
			TTransaction::log($sql->getInstruction());
			//executa instrução de DELETE
			$result = $conn->exec($sql->getInstruction());
			
			return $result;
		}
		else
		{
			//se não tiver transação, retorna uma execeção
			throw new Exception('Não há transação ativa');
		}
	}
	
	/*
	 * método count()
	 *  Retorna a quantidade de objetos da base de dados
	 *  que satisfazem um determinado critério de seleção
	 *  @param $criteria = objeto do tipo TCriteria
	 */
	function count(TCriteria $criteria)
	{
		//instancia instrução de SELECT
		$sql = new TSqlSelect;
		$sql->addColumn('count(*)');
		$sql->setEntity($this->class);
		//atribui o criterio passado como parâmetro
		$sql->setCriteria($criteria);
		
		//obtem transação ativa
		if ($conn = TTransaction::get())
		{
			//registra mensagem de LOG
			TTransaction::log($sql->getInstruction());
			//executa instrução de SELECT
			$result = $conn->Query($sql->getInstruction());
			
			if ($result)
			{
				$row = $result->fetch();
			}
			//retorna o resultado
			return $row[0];
		}
		else
		{
			//se não tiver transação, retorna uma execeção
			throw new Exception('Não há transação ativa');
		}
	}
}
?>