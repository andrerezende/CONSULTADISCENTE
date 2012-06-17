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
					<?php if (isset($userData) && !empty($userData)) :?>
						<div class="label label-info pull-left">
							<i class="icon-time icon-white"></i> Último login: <?php echo $this->Formatacao->dataCompleta($userData['ultimo_login']);?>
						</div>
						<ul class="nav pull-right">
							<li>
								<p class="navbar-text">
									<i class="icon-user icon-white"></i>  <?php echo $this->Util->cpf($userData['cpf']);?>
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
						</ul>
					<?php else:?>
						<ul class="nav pull-right">
							<li class="divider-vertical"></li>
							<li><?php echo $this->Html->link('Entrar', array('controller' => 'alunos', 'action' => 'login'));?></li>
						</ul>
					<?php endif;?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
