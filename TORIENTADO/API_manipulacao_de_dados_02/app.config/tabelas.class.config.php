<?php
/*
 * cria as classes Active Record
 *  para manipular os registros das tabelas correspondentes
 *  cria validações para parametros atribuidos as classes
 */
class CursoRecord extends TRecord{}
class AlunoRecord extends TRecord
{
	/*
	 * método get_inscricoes()
	 *  executado sempre que for acessada a propriedade "inscricoes"
	 */
	function get_inscricoes()
	{
		//cria um criterio de seleção
		$criteria = new TCriteria;
		//filtra por codigo do aluno
		$criteria->add(new TFilter(' ref_aluno ', '= ', $this->id));
		
		//instancia repositorio de Inscriçoes
		$repository = new TRepository('Inscricao');
		//retorna todas inscrições que satisfazem o criterio
		
		return $repository->load($criteria);
	}
	
	/*
	 * método Inscrever
	 *  cria uma inscrição para este aluno
	 *  @param $turma = número da tuma a ser inscrito
	 */
	function Inscrever($turma)
	{
		//instancia uma inscrição
		$inscricao = new InscricaoRecord;
		//define algumas propriedades
		$inscricao->ref_aluno = $this->id;
		$inscricao->ref_turma = $turma;
		$inscricao->cancelada = FALSE;
		$inscricao->concluida = FALSE;
		
		//persiste a inscrição
		$inscricao->store();
	}
}
class InscricaoRecord extends TRecord
{
	/*
	 * método get_aluno()
	 *  executado sempre que for acessada a propriedade "aluno"
	 */
	function get_aluno()
	{
		//instancia AlunoRecord, carrega
		//na memória o aluno de código $this->ref_aluno
		$aluno = new AlunoRecord($this->ref_aluno);
		
		//retorna o objeto instanciado
		return $aluno;
	}
}
class TurmaRecord extends TRecord
{
	/*
	 * método set_dia_semana()
	 * executado sempre que há uma atribuição para "dia_semana"
	 * valida o parametro
	 * $param $valor = valor atribuido
	 */
	function set_dia_semana($valor)
	{
		//verifica se o dia da semana está entre 1 e 7 e é numero
		if (is_int($valor) and ($valor>=1) and ($valor<=7))
		{
			//atribui o valor á propriedade
			$this->data['dia_semana'] = $valor;
		}
		else
		{
			//exibe mensagem de erro
			echo "Tentou atribuir '{$valor}' em dia_semana <br>\n";
		}
	}
	
	/*
	 * método set_turno()
	 * executado sempre que há uma atribuição para "turno"
	 * valida o parametro
	 * $param $valor = valor atribuido
	 */
	function set_turno($valor)
	{
		//verifica se o valor é M, T ou N
		if (($valor=='M') or ($valor=='T') or ($valor=='N'))
		{
			//atribui o valor á propriedade
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