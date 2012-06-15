<?php echo $this->Html->script('login', array('inline' => false));?>

<div class="row">
	<div class="login-form">
		<h2>Login</h2>
		<?php
		echo $this->Form->create('Aluno', array(
			'url' => array('controller' => 'alunos', 'action' => 'login'),
			'inputDefaults' => array('div' => false),
		));
		?>
			<fieldset>
				<div class="clearfix">
					<?php echo $this->Form->input('cpf', array('placeholder' => 'CPF', 'label' => false, 'class' => 'cpf'));?>
				</div>
				<div class="clearfix">
					<?php echo $this->Form->input('senha', array('placeholder' => 'Senha', 'label' => false, 'type' => 'password'));?>
				</div>
				<?php echo $this->Form->submit('Entrar', array('class' => 'btn btn-primary', 'type' => 'submit', 'label' => false, 'div' => false))?>
				<?php echo $this->Form->submit('Solicitar senha', array('id' => 'SolicitarSenha', 'class' => 'pull-right btn', 'type' => 'button', 'label' => false, 'div' => false))?>
			</fieldset>
		<?php echo $this->Form->end();?>
	</div>
</div>