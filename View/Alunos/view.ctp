<div class="alunos view">
<h2><?php  echo __('Aluno');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($aluno['Aluno']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cpf'); ?></dt>
		<dd>
			<?php echo h($aluno['Aluno']['cpf']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Senha'); ?></dt>
		<dd>
			<?php echo h($aluno['Aluno']['senha']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar Aluno'), array('action' => 'edit', $aluno['Aluno']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Excluir Aluno'), array('action' => 'delete', $aluno['Aluno']['id']), null, __('Você tem certeza que deseja excluir o # %s?', $aluno['Aluno']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Alunos'), array('action' => 'index')); ?> </li>
	</ul>
</div>
