
<?php echo $this->Html->docType('html5'); ?> 
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		 
		 <title>Unipam SI</title>
		 
		<?php
			echo $this->Html->meta('icon');
			
			echo $this->fetch('meta');
			
			echo $this->Html->css('bootstrap.min');
			// Uncomment this to enable the bootstrap gradient theme (Flat is way better though).
			//echo $this->Html->css('bootstrap-theme.min');
			echo $this->Html->css('core');
			echo $this->Html->css('style');
			echo $this->Html->css('style');
			echo $this->fetch('css');
			
			echo $this->Html->script('libs/jquery-1.10.2.min'); 
			echo $this->Html->script('libs/bootstrap.min');
			
			echo $this->fetch('script');
		?>
		
	</head>

	


		<div id="main-container">
		
			<?php // echo $this->element('menu/top_menu'); ?>
			
			
			
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container text-center ">
			 
				  
				  <img    src="img/logo_unipam.png"   class="img-rounded unipam_logo"  />
				  <div class="container">
						<a class="btn btn-info btn-mini botao_aluno " href="index.html"><i class="icon-globe icon-white"></i> Voltar ao site </a>
				  </div>
				  
			 
				</div>
			
			</div>
			
			<div id="content" class="container">
			
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div><!-- /#header .container -->
			
			<div id="footer" class="container">
				<?php //Silence is golden ?>
			</div><!-- /#footer .container -->
			
		</div><!-- /#main-container -->
		
		<div class="container">
			<div class="well well-sm">
				<small>
					<?php echo $this->element('sql_dump'); ?>
				</small>
			</div><!-- /.well well-sm -->
		</div><!-- /.container -->
		
	</body>

</html>