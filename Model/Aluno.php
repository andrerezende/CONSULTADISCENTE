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
		$this->useDbConfig = 'sigaedu';
		$this->useTable = false;

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

		$this->useDbConfig = 'default';
		$this->useTable = 'alunos';

		if (!empty($result)) {
			return $result[0][0]['email'];
		}
		return false;
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
