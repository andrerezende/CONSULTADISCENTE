<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			<?php echo __('Sistema de Consultas para Estudantes'); ?> - <?php echo $title_for_layout; ?>
		</title>
		<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array(
			'bootstrap',
			'bootstrap-responsive',
			'main',
		));
		echo $this->Html->script(array(
			'jquery',
			'jquery.maskedinput',
			'jquery.validate',
			'bootstrap',
		));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		?>
		<style type="text/css">
			body {
				padding-top: 50px;
				padding-bottom: 60px;
			}
			.navbar .brand {
				color: white;
			}
			.sidebar-nav {
				padding: 9px 0;
			}
		</style>
	</head>
	<body>
		<?php echo $this->element('nav');?>
		<div id="container">
			<div id="content">
				<div class="span12">
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->Session->flash('auth'); ?>
				</div>

				<?php echo $this->element('menu');?>
				<div class="span9">
					<?php echo $this->fetch('content'); ?>
					<?php echo $this->element('footer');?>
				</div>
			</div>
		</div>
	</body>
	<?php echo $this->Js->writeBuffer();?>
</html>
