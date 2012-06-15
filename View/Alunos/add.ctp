<div class="alunos form">
<?php echo $this->Form->create('Aluno');?>
	<fieldset>
		<legend><?php echo __('Incluir Aluno'); ?></legend>
	<?php
		echo $this->Form->input('cpf');
		echo $this->Form->input('senha');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar Alunos'), array('action' => 'index'));?></li>
	</ul>
</div>
