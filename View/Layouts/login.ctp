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
			/* Override some defaults */
			html, body {
				background-color: #eee;
			}
			body {
				padding-top: 190px;
			}
			.navbar .brand {
				color: white;
			}
			.container {
				width: 300px;
			}
			/* The white background content wrapper */
			.container > .content {
				background-color: #fff;
				padding: 20px;
				margin: 0 -20px;
				-webkit-border-radius: 10px 10px 10px 10px;
					-moz-border-radius: 10px 10px 10px 10px;
						border-radius: 10px 10px 10px 10px;
				-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
					-moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
						box-shadow: 0 1px 2px rgba(0,0,0,.15);
			}
			.login-form {
				margin-left: 65px;
			}
			fieldset {
				width: 220px;
			}
			legend {
				margin-right: -50px;
				font-weight: bold;
			}
	</style>
	</head>
	<body>
		<?php echo $this->element('nav');?>
		<div class="container">
			<div class="content">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Session->flash('auth'); ?>

				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
	</body>
	<?php echo $this->Js->writeBuffer();?>
</html>
