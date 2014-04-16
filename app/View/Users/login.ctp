
<?php echo $this->Session->flash('auth'); ?>


<div class="container"  >

	<?php echo $this->Form->create('User',array('class'=>'form-signin'));?>

		<h2 class="form-signin-heading">Painel do aluno</h2>
			<?= $this->Form->input('username',array('class'=>'input-block-level','placeholder'=>'Username','label'=>false,'type'=>'text')) ?>
			<?= $this->Form->input('password',array('class'=>'input-block-level','placeholder'=>'Senha','label'=>false)); ?>
			<label class="checkbox">
			  <input type="checkbox" value="remember-me"> Relembrar-me
			</label>
			<button class="btn btn-medium btn-primary" type="submit">Entrar</button>
		    <?= $this->Html->link('Solicitar Cadastro',array('controller'=>'users','action'=>'add'),array('class'=>'btn btn-medium btn-primary','style'=>'float:right;')); ?>
		</fieldset> 
	  
	<?php echo $this->Form->end();?>
 
</div> <!-- /container -->



