<?php echo $this->Html->script('alunos_index', array('inline' => false));?>

<div class="alunos index">
	<div class="tabbable">
		<ul class="nav nav-tabs">
			<li class="tab active" id="avaliacoes_faltas-tab" href="/alunos/avaliacoes_faltas">
				<?php echo $this->Html->link('Avaliações / Faltas', '#avaliacoes_faltas', array('data-toggle' => 'tab'));?>
			</li>
		</ul>

		<div class="tab-content">
			<div id="avaliacoes_faltas" class="tab-pane active">
				<div class="span8">
					<?php
					echo $this->Form->create('Aluno', array(
						'inputDefaults' => array(
							'div' => false,
							'class' => 'span8',
							'empty' => 'Selecione'
						)
					));
					?>
					<?php
					echo $this->Form->inputs(array(
						'legend' => false,
						'fieldset' => false,
						'aluno' => array('readonly' => true, 'value' => $this->Session->read('Aluno.Matricula.nome')),
						'curso' => array('type' => 'select', 'options' => $cursos, 'value' => $this->Session->read('Aluno.Filters.curso')),
						'elemento_curricular' => array('type' => 'select', 'options' => $elementos, 'value' => $this->Session->read('Aluno.Filters.elemento_curricular')),
					));
					?>
					<?php echo $this->Form->button('Filtrar', array('class' => 'btn btn-primary'));?>
					<?php echo $this->Form->end();?>
				</div>
				<table class="table table-condensed span6" id="avaliacoes-table">
					<thead>
						<tr>
							<th class="title" colspan="2">AVALIAÇÕES</th>
						</tr>
						<tr>
							<th>AVALIAÇÃO</th>
							<th>NOTA</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
				<table class="table table-condensed span2" id="faltas-table">
					<thead>
						<tr>
							<th class="title" colspan="2">FALTAS</th>
						</tr>
						<tr>
							<th>DATA</th>
							<th>FREQUÊNCIA</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
