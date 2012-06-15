<?php echo $this->Html->script('alterar_senha', array('inline' => false));?>

<div class="row">
	<div class="login-form">
		<h2>Alterar Senha</h2>
		<?php
		echo $this->Form->create('Aluno', array(
			'url' => array('controller' => 'alunos', 'action' => 'alterar_senha'),
			'inputDefaults' => array('div' => false),
		));
		?>
			<fieldset>
				<div class="clearfix">
					<?php echo $this->Form->input('senha_atual', array('placeholder' => 'Senha Atual', 'label' => false, 'type' => 'password'));?>
				</div>
				<div class="clearfix">
					<?php echo $this->Form->input('nova_senha', array('placeholder' => 'Nova Senha', 'label' => false, 'type' => 'password'));?>
				</div>
				<div class="clearfix">
					<?php echo $this->Form->input('confirmar_senha', array('placeholder' => 'Confirmar Senha', 'label' => false, 'type' => 'password'));?>
				</div>
				<?php echo $this->Form->submit('Enviar', array('class' => 'btn btn-primary', 'type' => 'submit', 'label' => false, 'div' => false))?>
			</fieldset>
		<?php echo $this->Form->end();?>
	</div>
</div>