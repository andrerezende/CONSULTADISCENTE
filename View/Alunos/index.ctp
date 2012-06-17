<div class="alunos index">
	<div class="tabbable">
		<ul class="nav nav-tabs">
			<li class="active">
				<?php echo $this->Html->link('Notas', '#notas', array('data-toggle' => 'tab'));?>
			</li>
			<li>
				<?php echo $this->Html->link('Faltas', '#faltas', array('data-toggle' => 'tab'));?>
			</li>
			<li>
				<?php echo $this->Html->link('Conteúdo Programático', '#conteudo-programatico', array('data-toggle' => 'tab'));?>
			</li>
		</ul>

		<div class="tab-content">
			<div id="notas" class="tab-pane active">
				<?php
				echo $this->Form->create();
				echo $this->Form->input('ano_letivo');
				echo $this->Form->input('unidade');
				echo $this->Form->input('turno');
				echo $this->Form->submit('Enviar', array('class' => 'btn btn-primary'));
				echo $this->Form->end();
				?>
			</div>
			<div id="faltas" class="tab-pane">
				<?php
				echo $this->Form->create();
				echo $this->Form->input('ano_letivo');
				echo $this->Form->input('unidade');
				echo $this->Form->submit('Enviar', array('class' => 'btn btn-primary'));
				echo $this->Form->end();
				?>
			</div>
			<div id="conteudo-programatico" class="tab-pane">
				<?php
				echo $this->Form->create();
				echo $this->Form->input('ano_letivo');
				echo $this->Form->submit('Enviar', array('class' => 'btn btn-primary'));
				echo $this->Form->end();
				?>
			</div>
		</div>
	</div>
</div>
