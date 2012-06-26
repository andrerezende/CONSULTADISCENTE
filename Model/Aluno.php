<?php
App::uses('AuthComponent', 'Controller/Component');
App::uses('AppModel', 'Model');
/**
 * Aluno Model
 *
 */
class Aluno extends AppModel {

	public $displayField = 'cpf';

	public function beforeSave() {
		if (isset($this->data[$this->alias]['senha'])) {
			$this->data[$this->alias]['senha'] = AuthComponent::password($this->data[$this->alias]['senha']);
		}
	}

	public function alterarSenha($data) {
		$pass = $this->field('senha');

		if ($pass == AuthComponent::password($data[$this->alias]['senha_atual'])) {
			if ($data[$this->alias]['nova_senha'] == $data[$this->alias]['confirmar_senha']) {
				$this->set(array('senha' => $data[$this->alias]['nova_senha']));
				return $this->save();
			}
		}
		return false;
	}

	public function check($data) {
		$this->setSigaeduDb();

		$query = <<<QUERY
SELECT pf.email
FROM aluno a
	INNER JOIN documento_identificacao di ON di.pessoa_fisica_id = a.pessoa_fisica_id
	INNER JOIN pessoa_fisica pf ON pf.id = a.pessoa_fisica_id
WHERE
	di.tipo_doc_identificacao = 'CPF'
	AND di.numero = (('{$data[$this->alias]['cpf']}'::float)::varchar)
LIMIT 1
QUERY;

		$result = $this->query($query);
		$this->resetDb();

		if (!empty($result)) {
			return $result[0][0]['email'];
		}
		return false;
	}

	public function findMatriculaAluno() {
		$cpf = $this->field('cpf');
		$this->setSigaeduDb();

		$query = <<<QUERY
SELECT
    pf.id AS ID_PF,
    pf.nome AS NOME,
    pf.email,
    di.tipo_doc_identificacao AS DOCUMENTO_TIPO_CPF,
    di.numero AS N_CPF,
	mt.id AS ID_MATRICULA,
    mt.numero AS N_MATRICULA,
    cu.nome AS CURSO
FROM
    aluno al,
    pessoa_fisica pf,
    documento_identificacao di,
    matricula mt,
    matriz_curricular mc,
    curso cu

WHERE
    pf.id = al.pessoa_fisica_id
    AND pf.id = di.pessoa_fisica_id
    AND di.tipo_doc_identificacao = 'CPF'
    AND di.numero = (('{$cpf}'::float)::varchar)
    AND al.pessoa_fisica_id = mt.aluno_id
    AND mt.status_aluno_curso_id = 12
    AND mc.id = mt.matriz_curricular_id
    AND cu.id = mc.curso_id
LIMIT 1
QUERY;
		$result = $this->query($query);
		$this->resetDb();

		return current($result[0]);
	}

	public function getAlunoCursos($matricula) {
		$this->setSigaeduDb();

		$query = <<<QUERY
SELECT
	mt.id AS ID_MATRICULA,
	mt.numero AS N_MATRICULA,
	mc.id AS ID_MATRIZ,
	cu.nome AS CURSO,
	cu.id AS ID_CURSO
FROM
	matricula mt,
	matriz_curricular mc,
	curso cu
WHERE
	mt.numero = '{$matricula}'
	AND mc.id = mt.matriz_curricular_id
	AND cu.id = mc.curso_id
QUERY;
		$result = $this->query($query);
		$this->resetDb();

		$list = array();
		foreach ($result as $res) {
			$list += Set::combine($res, '{n}.id_curso', '{n}.curso');
		}
		return $list;
	}

	public function getAlunoNotas($idMatricula, $filters = null) {
		$this->setSigaeduDb();

		$elementoCurricular = $filters['elemento_curricular'] != null ? 'AND ec.id = ' . $filters['elemento_curricular'] : '';
		$curso = $filters['curso'] != null ? 'AND cu.id = ' . $filters['curso'] : '';

		$query = <<<QUERY
SELECT
	mt.id AS N_MATRICULA,
	av.id AS ID_AVA,
	av.descricao AS DESC_AVA,
	ra.id AS RES_AVA_ID,
	ra.nota,
	cl.id AS ID_CLASSE,
	cl.descricao AS DESC_CLASSE,
	mc.id AS ID_MATRIZ,
	cu.id AS ID_CURSO,
	cu.nome AS CURSO,
	em.elemento_curricular_id AS ID_ELEM_CURRIC,
	ec.nome AS NOME_ELEMENTO_CURRICULAR
FROM
	matricula mt,
	avaliacao av,
	resultado_avaliacao ra,
	classe cl,
	matriz_curricular mc,
	curso cu,
	elemento_matriz em,
	elemento_curricular ec

WHERE
	mt.id = {$idMatricula}
    {$elementoCurricular}
    {$curso}
	AND mt.id = ra.matricula_id
	AND av.id = ra.avaliacao_id
	AND cl.id = av.classe_id
	AND mc.id = cl.matriz_id
	AND cu.id = mc.curso_id
	AND em.matriz_curricular_id = mc.id
	AND em.matriz_curricular_id = ec.id

ORDER BY
	n_matricula, id_elem_curric
QUERY;

		$result = $this->query($query);
		$this->resetDb();

		return $result;
	}

	public function getAlunoFaltas($idMatricula, $filters = null) {
		$this->setSigaeduDb();

		$elementoCurricular = $filters['elemento_curricular'] != null ? 'AND ec.id = ' . $filters['elemento_curricular'] : '';
		$curso = $filters['curso'] != null ? 'AND ec.curso_id = ' . $filters['curso'] : '';

		$query = <<<QUERY
SELECT
	mt.id AS N_MATRICULA,
	au.id AS ID_AULA,
	au.data_aula,
	fa.presenca AS PRESENCA,
	cl.id AS ID_CLASSE,
	di.elemento_curricular_id AS ID_ELEM_CURRICULAR,
	ec.nome AS ELEMENTO_CURRICULAR,
	mc.id AS ID_MATRIZ

FROM
	falta fa,
	aula au,
	matricula mt,
	classe cl,
	disciplina di,
	elemento_curricular ec,
	matriz_curricular mc,
	elemento_matriz em

WHERE
    mt.id = {$idMatricula}
    {$elementoCurricular}
    {$curso}
	AND mt.id = fa.matricula_id
	AND cl.id = fa.classe_id
	AND cl.id = au.classe_id
	AND au.id = fa.aula_id
	AND ec.id = di.elemento_curricular_id
	AND cl.disciplina_id = di.elemento_curricular_id
	AND mc.id = cl.matriz_id
	AND mc.id = em.matriz_curricular_id
	AND ec.id = em.elemento_curricular_id

ORDER BY
	n_matricula, elemento_curricular
QUERY;

		$result = $this->query($query);
		$this->resetDb();

		return $result;
	}

	public function getAlunoElementos() {
		$this->setSigaeduDb();

		$query = <<<QUERY
SELECT
	id,
	nome
FROM
	elemento_curricular
WHERE curso_id IN (77, 79)
ORDER BY nome
QUERY;

		$result = $this->query($query);
		$this->resetDb();

		$list = array();
		foreach ($result as $res) {
			$list += Set::combine($res, '{n}.id', '{n}.nome');
		}
		return $list;
	}

	private function setSigaeduDb() {
		$this->useDbConfig = 'sigaedu';
		$this->useTable = false;
	}

	private function resetDb() {
		$this->useDbConfig = 'default';
		$this->useTable = 'alunos';
	}

	public function cleanMasks($data) {
		if (isset($data[$this->alias]['cpf'])) {
			$data[$this->alias]['cpf'] = $this->cleanMaskCPF($data[$this->alias]['cpf']);
		}

		return $data;
	}

	public function cleanMaskCPF($cpf) {
		return str_replace(
			array('.', '-'), '',
			$cpf
		);
	}

	public function generateNewPassword($data) {
		if ($this->check($data)) {
			$aluno = $this->find('first', array('conditions' => array(
				'cpf' => $data[$this->alias]['cpf'],
			)));
			$newPass = uniqid();
			if (!$aluno) {
				$this->create();
				$this->set(array(
					'cpf' => $data[$this->alias]['cpf'],
					'senha' => $newPass,
				));
			} else {
				$this->id = $aluno[$this->alias]['id'];
				$this->set(array(
					'senha' => $newPass,
				));
			}
			$this->save();
			return $newPass;
		}
		return false;
	}

}
