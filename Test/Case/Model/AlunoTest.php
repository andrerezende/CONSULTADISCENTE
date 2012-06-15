<?php
App::uses('Aluno', 'Model');

/**
 * Aluno Test Case
 *
 */
class AlunoTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.aluno');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Aluno = ClassRegistry::init('Aluno');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Aluno);

		parent::tearDown();
	}

}