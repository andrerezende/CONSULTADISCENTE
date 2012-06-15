<?php
class UtilHelper extends AppHelper {

	public $helper = array(
		'Html',
		'Js' => array('Jquery'),
	);

	public function cpf($cpf) {
		return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
	}

}