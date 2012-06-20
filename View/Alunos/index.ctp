<?php echo $this->Html->script('alunos_index', array('inline' => false));?>

<div class="alunos index">
	<div class="tabbable">
		<ul class="nav nav-tabs">
			<li class="tab" id="cursos-tab" href="/alunos/cursos">
				<?php echo $this->Html->link('Cursos', '#cursos', array('data-toggle' => 'tab'));?>
			</li>
			<li class="tab" id="notas-tab" href="/alunos/notas">
				<?php echo $this->Html->link('Notas', '#notas', array('data-toggle' => 'tab'));?>
			</li>
			<li class="tab" id="faltas-tab" href="/alunos/faltas">
				<?php echo $this->Html->link('Faltas', '#faltas', array('data-toggle' => 'tab'));?>
			</li>
			<li class="tab disabled" id="conteudo_programatico-tab" href="/alunos/conteudo_programatico">
				<?php echo $this->Html->link('Conteúdo Programático', '#conteudo-programatico', array('data-toggle' => 'tab'));?>
			</li>
		</ul>

		<div class="tab-content">
			<div id="cursos" class="tab-pane"><ul></ul></div>
			<div id="notas" class="tab-pane">
				<table class="table table-condensed">
					<thead>
						<tr>
							<th>Curso</th>
							<th>Elemento Curricular</th>
							<th>Avaliação</th>
							<th>Nota</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			<div id="faltas" class="tab-pane">
				<table class="table table-condensed">
					<thead>
						<tr>
							<th>#</th>
							<th>Data da Aula</th>
							<th colspan="2">Frequência</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			<div id="conteudo-programatico" class="tab-pane"><ul></ul></div>
		</div>
	</div>
</div>
