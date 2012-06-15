<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container-fluid">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<?php echo $this->Html->link('Sistema de Consultas para Estudantes', '/', array('class' => 'brand'));?>
			<div class="nav-collapse">
				<div class="nav-collapse">
					<ul class="nav pull-right">
						<?php if (isset($userData) && !empty($userData)) :?>
							<li>
								<p class="navbar-text">
									<i class="icon-user icon-white"></i> <?php echo $this->Html->link(
										//$this->Util->cpf($userData['cpf']),
											'',
										array('controller' => 'alunos', 'action' => 'edit', $userData['id']
									));?>
								</p>
							</li>
							<li class="divider-vertical"></li>
							<li>
								<p class="navbar-text">
									<i class="icon-edit icon-white"></i> <?php echo $this->Html->link('Alterar senha', array(
										'controller' => 'alunos', 'action' => 'alterar_senha'
									));?>
								</p>
							</li>
							<li class="divider-vertical"></li>
							<li>
								<p class="navbar-text">
									<i class="icon-off icon-white"></i> <?php echo $this->Html->link('Sair', array(
										'controller' => 'alunos', 'action' => 'logout'
									));?>
								</p>
							</li>
							<li class="divider-vertical"></li>
						<?php else:?>
							<li class="divider-vertical"></li>
							<li><?php echo $this->Html->link('Entrar', array('controller' => 'alunos', 'action' => 'login'));?></li>
						<?php endif;?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
