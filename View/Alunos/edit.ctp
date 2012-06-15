<div class="alunos form">
<?php echo $this->Form->create('Aluno');?>
	<fieldset>
		<legend><?php echo __('Editar Aluno'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('cpf');
		echo $this->Form->input('senha');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Excluir'), array('action' => 'delete', $this->Form->value('Aluno.id')), null, __('Você tem certeza que deseja excluir o # %s?', $this->Form->value('Aluno.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Alunos'), array('action' => 'index'));?></li>
	</ul>
</div>
