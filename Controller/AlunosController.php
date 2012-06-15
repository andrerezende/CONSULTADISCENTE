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
		$this->Aluno->recursive = 0;
		$this->set('alunos', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Aluno->id = $id;
		if (!$this->Aluno->exists()) {
			throw new NotFoundException(__('Aluno inválido'));
		}
		$this->set('aluno', $this->Aluno->read(null, $id));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Aluno->id = $id;
		if (!$this->Aluno->exists()) {
			throw new NotFoundException(__('Aluno inválido.'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Aluno->save($this->request->data)) {
				$this->Session->setFlash(__('O aluno foi salvo.'), 'flash_auth');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O aluno não pode ser salvo. Por favor, tente novamente.'), 'flash_auth');
			}
		} else {
			$this->request->data = $this->Aluno->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Aluno->id = $id;
		if (!$this->Aluno->exists()) {
			throw new NotFoundException(__('aluno inválido.'));
		}
		if ($this->Aluno->delete()) {
			$this->Session->setFlash(__('Aluno excluído.'), 'flash_auth');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Aluno não pode ser excluído.'), 'flash_auth');
		$this->redirect(array('action' => 'index'));
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
