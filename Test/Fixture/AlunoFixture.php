?>
<?php
/**
 * AlunoFixture
 *
 */
class AlunoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'cpf' => array('type' => 'string', 'null' => true, 'length' => 11),
		'senha' => array('type' => 'string', 'null' => true),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'), 'unique_cpf' => array('unique' => true, 'column' => 'cpf')),
		'tableParameters' => array()
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'cpf' => 'Lorem ips',
			'senha' => 'Lorem ipsum dolor sit amet'
		),
	);
}