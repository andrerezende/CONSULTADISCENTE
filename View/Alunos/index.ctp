<div class="alunos index">
	<h2><?php echo __('Alunos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('cpf');?></th>
			<th><?php echo $this->Paginator->sort('senha');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
	</tr>
	<?php foreach ($alunos as $aluno): ?>
	<tr>
		<td><?php echo h($aluno['Aluno']['id']); ?>&nbsp;</td>
		<td><?php echo $this->Util->cpf($aluno['Aluno']['cpf']); ?>&nbsp;</td>
		<td><?php echo h($aluno['Aluno']['senha']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $aluno['Aluno']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $aluno['Aluno']['id'])); ?>
			<?php echo $this->Form->postLink(__('Excluir'), array('action' => 'delete', $aluno['Aluno']['id']), null, __('Você tem certeza que deseja excluir o # %s?', $aluno['Aluno']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de {:count}, começando no registro {:start}, e terminando no {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('anterior'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('próxima') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
