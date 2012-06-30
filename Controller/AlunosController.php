<?php
App::uses('AppController', 'Controller');
/**
 * Alunos Controller
 *
 * @property Aluno $Aluno
 */
class AlunosController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('solicitar_senha', 'logout');
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if ($this->request->is('post')) {
			$this->Session->write('Filters', $this->request->data[$this->modelClass]);
		}

		$aluno = $this->Session->read('Aluno');
		$cursos = array();
		$matriculas = array();
		foreach($aluno as $matricula) {
			if (isset($matricula[0]['id_curso'])) {
				$cursos += array($matricula[0]['id_curso'] => $matricula[0]['curso']);
				$matriculas += array($matricula[0]['id_curso'] => $matricula[0]['id_matricula']);
			}
		}
		$this->Session->write('Cursos', $cursos);
		$this->Session->write('Matriculas', $matriculas);
		$elementos = $this->Aluno->getAlunoElementos(array_keys($cursos));
		$this->set(compact('cursos', 'elementos', 'matriculas'));
	}

	public function avaliacoes_faltas() {
		$this->autoRender = false;
		$notas = $this->Aluno->getAlunoNotas(
			$this->request->query['elementoCurricular'],
			$this->request->query['matricula'],
			$this->request->query['curso'],
			$this->Session->read('Filters')
		);
		$faltas = $this->Aluno->getAlunoFaltas(
			$this->request->query['elementoCurricular'],
			$this->request->query['matricula'],
			$this->request->query['curso'],
			$this->Session->read('Filters')
		);
		if ($this->request->is('ajax')) {
			return new CakeResponse(array(
				'body' => json_encode(array($notas, $faltas)),
				'type' => 'json',
			));
		}
		return array($notas, $faltas);
	}


/**
 * login method
 *
 * @return void
 */
	public function login() {
		if ($this->request->is('post')) {
			$this->request->data = $this->Aluno->cleanMasks($this->request->data);

			if ($this->Auth->login()) {
				$this->Aluno->id = $this->Auth->user('id');
				$this->Aluno->saveField('ultimo_login', date('Y-m-d H:i:s'));

				$this->Session->write('Aluno', $this->Aluno->findMatriculaAluno());

				$this->Session->setFlash('Login feito com sucesso', 'flash_auth', array(), 'auth');
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('CPF ou senha inválidos'), 'flash_auth', array(), 'auth');
				unset($this->request->data[$this->modelClass]['senha']);
			}
		}
	}

/**
 * logout method
 *
 * @return void
 */
	public function logout() {
		$this->Session->destroy();
		$this->redirect($this->Auth->logout());
	}

/**
 * alterar_senha method
 *
 * @return void
 */
	public function alterar_senha() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Aluno->id = $this->Auth->user('id');
			if (!$this->Aluno->exists()) {
				throw new NotFoundException(__('Aluno inválido.'));
			}
			if ($this->Aluno->alterarSenha($this->request->data)) {
				$this->Session->setFlash('Senha alterada com sucesso', 'flash_auth');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('A senha não foi alterada, preencha o formulário corretamente', 'flash_auth');
			}
		}
	}

	public function solicitar_senha() {
		if ($this->request->is('post')) {
			$this->request->data = $this->Aluno->cleanMasks($this->request->data);
			$emailAluno = $this->Aluno->check($this->request->data);
			if ($emailAluno) {
				$newPass = $this->Aluno->generateNewPassword($this->request->data);
				$CakeEmail = $this->_getMailInstance();
				$CakeEmail->config('smtp')
						->helpers(array('Html', 'Util'))
						->template('solicitar_senha', 'default')
						->emailFormat('html')
						->viewVars(array(
							'cpf' => $this->request->data[$this->modelClass]['cpf'],
							'senha' => $newPass
						))
						->to($emailAluno)
						->subject('Solicitação de Senha - Consulta para Estudantes');
				if ($CakeEmail->send()) {
					$this->Session->setFlash('Uma senha foi gerada e enviada para o seu email', 'flash_auth');
				}
			} else {
				$this->Session->setFlash('CPF não encotrado', 'flash_auth');
			}
		}
	}

}
