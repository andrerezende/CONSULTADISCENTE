<?php
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $helpers = array(
		'Html',
		'Form',
		'Session',
		'Time',
		'Util',
		'Js' => array('Jquery'),
		'CakePtbr.Formatacao',
	);

	public $components = array(
		'Auth',
		'Session',
		'Paginator',
		'DebugKit.Toolbar',
		'RequestHandler',
	);

	public $layout = 'default';

/**
 * beforeFilter
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();

		$this->_setUpAuth();
	}

/**
 * beforeRender
 *
 * @return void
 */
	public function beforeRender() {
		parent::beforeRender();

		$this->_setUpUser();

		if (in_array($this->request->action, array('login', 'solicitar_senha', 'alterar_senha'))) {
			$this->layout = 'login';
		}
	}

/**
 * _setUpAuth
 *
 * @return void
 */
	protected function _setUpAuth() {
		$this->Auth->authenticate = array(
			AuthComponent::ALL => array(
				'userModel' => 'Aluno',
				'fields' => array(
					'username' => 'cpf',
					'password' => 'senha',
				),
			),
			'Form',
		);

		$this->Auth->flash = array(
			'element' => 'flash_auth',
			'key' => 'auth',
			'params' => array(),
		);

		$this->Auth->loginAction = array(
			'prefix' => false,
			'admin' => false,
			'plugin' => false,
			'controller' => 'alunos',
			'action' => 'login',
		);

		$this->Auth->logoutRedirect = array(
			'prefix' => false,
			'admin' => false,
			'plugin' => false,
			'controller' => 'alunos',
			'action' => 'login',
		);

		$this->Auth->loginRedirect = array(
			'prefix' => false,
			'admin' => false,
			'plugin' => false,
			'controller' => 'alunos',
			'action' => 'index',
		);

		if ($this->request->action == 'login') {
			$this->Auth->autoRedirect = false;
		}
	}

	protected function _setUpUser() {
		$userData = $this->Session->read('Auth.User');
		if ($userData) {
			$this->set(compact('userData'));
		}
	}

/**
 * Returns a CakeEmail object
 *
 * @return CakeEmail
 */
	protected function _getMailInstance() {
		App::uses('CakeEmail', 'Network/Email');
		$CakeEmail = new CakeEmail();
		$CakeEmail->config('smtp');

		return $CakeEmail;
	}

}