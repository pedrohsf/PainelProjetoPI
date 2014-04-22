
<div id="page-container" class="row">

	<div id="sidebar" class="col-sm-3">
		
		<div class="actions">
			
			<ul class="list-group">			
						<li class="list-group-item"><?php echo $this->Html->link(__('Editar Project'), array('action' => 'edit', $project['Project']['id']), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Form->postLink(__('Apagar Project'), array('action' => 'delete', $project['Project']['id']), array('class' => ''), __('Tem certeza que deseja apagar este item? %s', $project['Project']['id'])); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('Listar Projects'), array('action' => 'index'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('Novo Project'), array('action' => 'add'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('Listar Users'), array('controller' => 'users', 'action' => 'index'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('Novo User'), array('controller' => 'users', 'action' => 'add'), array('class' => '')); ?> </li>
				
			</ul><!-- /.list-group -->
			
		</div><!-- /.actions -->
		
	</div><!-- /#sidebar .span3 -->
	
	<div id="page-content" class="col-sm-9">
		
		<div class="projects view">

			<h2><?php  echo __('Project'); ?></h2>
			
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<tbody>
						<tr>		<td><strong><?php echo __('Id'); ?></strong></td>
		<td>
			<?php echo h($project['Project']['id']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Description'); ?></strong></td>
		<td>
			<?php echo h($project['Project']['description']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('User'); ?></strong></td>
		<td>
			<?php echo $this->Html->link($project['User']['name'], array('controller' => 'users', 'action' => 'view', $project['User']['id']), array('class' => '')); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Accepted'); ?></strong></td>
		<td>
			<?php echo h($project['Project']['accepted']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Supervisor Description'); ?></strong></td>
		<td>
			<?php echo h($project['Project']['supervisor_description']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Filename'); ?></strong></td>
		<td>
			<?php echo h($project['Project']['filename']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Dir'); ?></strong></td>
		<td>
			<?php echo h($project['Project']['dir']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Filesize'); ?></strong></td>
		<td>
			<?php echo h($project['Project']['filesize']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Mimetype'); ?></strong></td>
		<td>
			<?php echo h($project['Project']['mimetype']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Created'); ?></strong></td>
		<td>
			<?php echo h($project['Project']['created']); ?>
			&nbsp;
		</td>
</tr>					</tbody>
				</table><!-- /.table table-striped table-bordered -->
			</div><!-- /.table-responsive -->
			
		</div><!-- /.view -->

			
	</div><!-- /#page-content .span9 -->

</div><!-- /#page-container .row-fluid -->
