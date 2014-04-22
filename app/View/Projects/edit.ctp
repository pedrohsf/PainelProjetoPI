
<div id="page-container" class="row">

	<div id="sidebar" class="col-sm-3">
		
		<div class="actions">
		
			<ul class="list-group">
										<li class="list-group-item"><?php echo $this->Form->postLink(__('Apagar'), array('action' => 'delete', $this->Form->value('Project.id')), null, __('Tem certeza que deseja apagar este item? %s', $this->Form->value('Project.id'))); ?></li>
										<li class="list-group-item"><?php echo $this->Html->link(__('Listar Projects'), array('action' => 'index')); ?></li>
						<li class="list-group-item"><?php echo $this->Html->link(__('Listar Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('Novo User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
			</ul><!-- /.list-group -->
		
		</div><!-- /.actions -->
		
	</div><!-- /#sidebar .col-sm-3 -->
	
	<div id="page-content" class="col-sm-9">

		<div class="projects form">
			
			<?php echo $this->Form->create('Project', array('inputDefaults' => array('label' => false), 'role' => 'form')); ?>
				<fieldset>
					<h2><?php echo __('Edit Project'); ?></h2>
			<div class="form-group">
		<?php echo $this->Form->input('id', array('class' => 'form-control')); ?>
</div><!-- .form-group -->

<div class="form-group">
	<?php echo $this->Form->label('description', 'description');?>
		<?php echo $this->Form->input('description', array('class' => 'form-control')); ?>
</div><!-- .form-group -->

<div class="form-group">
	<?php echo $this->Form->label('user_id', 'user_id');?>
		<?php echo $this->Form->input('user_id', array('class' => 'form-control')); ?>
</div><!-- .form-group -->

<div class="form-group">
	<?php echo $this->Form->label('accepted', 'accepted');?>
		<?php echo $this->Form->input('accepted', array('class' => 'form-control')); ?>
</div><!-- .form-group -->

<div class="form-group">
	<?php echo $this->Form->label('supervisor_description', 'supervisor_description');?>
		<?php echo $this->Form->input('supervisor_description', array('class' => 'form-control')); ?>
</div><!-- .form-group -->

<div class="form-group">
	<?php echo $this->Form->label('filename', 'filename');?>
		<?php echo $this->Form->input('filename', array('class' => 'form-control','type' => 'file')); ?>
</div><!-- .form-group -->

<div class="form-group">
		<?php echo $this->Form->input('dir', array('class' => 'form-control','type' => 'hidden')); ?>
</div><!-- .form-group -->

<div class="form-group">
		<?php echo $this->Form->input('filesize', array('class' => 'form-control','type' => 'hidden')); ?>
</div><!-- .form-group -->

<div class="form-group">
		<?php echo $this->Form->input('mimetype', array('class' => 'form-control','type' => 'hidden')); ?>
</div><!-- .form-group -->

				</fieldset>
			<?php echo $this->Form->submit('Enviar', array('class' => 'btn btn-large btn-primary')); ?>
<?php echo $this->Form->end(); ?>
			
		</div><!-- /.form -->
			 
	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->
