<?php
/*
 * cria as classes Active Record
 *  para manipular os registros das tabelas correspondentes
 *  cria valida��es para parametros atribuidos as classes
 */
class CursoRecord extends TRecord{}
class AlunoRecord extends TRecord
{
	/*
	 * m�todo get_inscricoes()
	 *  executado sempre que for acessada a propriedade "inscricoes"
	 */
	function get_inscricoes()
	{
		//cria um criterio de sele��o
		$criteria = new TCriteria;
		//filtra por codigo do aluno
		$criteria->add(new TFilter(' ref_aluno ', '= ', $this->id));
		
		//instancia repositorio de Inscri�oes
		$repository = new TRepository('Inscricao');
		//retorna todas inscri��es que satisfazem o criterio
		
		return $repository->load($criteria);
	}
	
	/*
	 * m�todo Inscrever
	 *  cria uma inscri��o para este aluno
	 *  @param $turma = n�mero da tuma a ser inscrito
	 */
	function Inscrever($turma)
	{
		//instancia uma inscri��o
		$inscricao = new InscricaoRecord;
		//define algumas propriedades
		$inscricao->ref_aluno = $this->id;
		$inscricao->ref_turma = $turma;
		$inscricao->cancelada = FALSE;
		$inscricao->concluida = FALSE;
		
		//persiste a inscri��o
		$inscricao->store();
	}
}
class InscricaoRecord extends TRecord
{
	/*
	 * m�todo get_aluno()
	 *  executado sempre que for acessada a propriedade "aluno"
	 */
	function get_aluno()
	{
		//instancia AlunoRecord, carrega
		//na mem�ria o aluno de c�digo $this->ref_aluno
		$aluno = new AlunoRecord($this->ref_aluno);
		
		//retorna o objeto instanciado
		return $aluno;
	}
}
class TurmaRecord extends TRecord
{
	/*
	 * m�todo set_dia_semana()
	 * executado sempre que h� uma atribui��o para "dia_semana"
	 * valida o parametro
	 * $param $valor = valor atribuido
	 */
	function set_dia_semana($valor)
	{
		//verifica se o dia da semana est� entre 1 e 7 e � numero
		if (is_int($valor) and ($valor>=1) and ($valor<=7))
		{
			//atribui o valor � propriedade
			$this->data['dia_semana'] = $valor;
		}
		else
		{
			//exibe mensagem de erro
			echo "Tentou atribuir '{$valor}' em dia_semana <br>\n";
		}
	}
	
	/*
	 * m�todo set_turno()
	 * executado sempre que h� uma atribui��o para "turno"
	 * valida o parametro
	 * $param $valor = valor atribuido
	 */
	function set_turno($valor)
	{
		//verifica se o valor � M, T ou N
		if (($valor=='M') or ($valor=='T') or ($valor=='N'))
		{
			//atribui o valor � propriedade
			$this->data['turno'] = $valor;
		}
		else
		{
			//exibe mensagem de erro
			echo "Tentou atribuir '{$valor}' em turno <br>\n";
		}
	}
}

?>