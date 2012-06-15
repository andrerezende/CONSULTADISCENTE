<?php echo $this->Html->script('login', array('inline' => false));?>

<div class="row">
	<div class="login-form">
		<h2>Solicitar Senha</h2>
		<?php
		echo $this->Form->create('Aluno', array(
			'url' => array('controller' => 'alunos', 'action' => 'solicitar_senha'),
			'inputDefaults' => array('div' => false),
		));
		?>
			<fieldset>
				<div class="clearfix">
					<?php echo $this->Form->input('cpf', array('placeholder' => 'CPF', 'label' => false, 'class' => 'cpf'));?>
				</div>
				<?php echo $this->Form->submit('Enviar', array('class' => 'btn btn-primary', 'type' => 'submit', 'label' => false, 'div' => false))?>
			</fieldset>
		<?php echo $this->Form->end();?>
	</div>
</div>