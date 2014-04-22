
<div id="page-container" class="row">

	<div id="sidebar" class="col-sm-3">
		
		<div class="actions">
		
			<ul class="list-group">
				<li class="list-group-item"><?php echo $this->Html->link(__('Novo Project'), array('action' => 'add'), array('class' => '')); ?></li>						<li class="list-group-item"><?php echo $this->Html->link(__('Listar Users'), array('controller' => 'users', 'action' => 'index'), array('class' => '')); ?></li> 
		<li class="list-group-item"><?php echo $this->Html->link(__('Novo User'), array('controller' => 'users', 'action' => 'add'), array('class' => '')); ?></li> 
			</ul><!-- /.list-group -->
			
		</div><!-- /.actions -->
		
	</div><!-- /#sidebar .col-sm-3 -->
	
	<div id="page-content" class="col-sm-9">

		<div class="projects index">
		
			<h2><?php echo __('Projects'); ?></h2>
			
			<div class="table-responsive">
				<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
					<thead>
						<tr>
															<th><?php echo $this->Paginator->sort('id'); ?></th>
															<th><?php echo $this->Paginator->sort('description'); ?></th>
															<th><?php echo $this->Paginator->sort('user_id'); ?></th>
															<th><?php echo $this->Paginator->sort('accepted'); ?></th>
															<th><?php echo $this->Paginator->sort('supervisor_description'); ?></th>
															<th><?php echo $this->Paginator->sort('filename'); ?></th>
															<th><?php echo $this->Paginator->sort('dir'); ?></th>
															<th><?php echo $this->Paginator->sort('filesize'); ?></th>
															<th><?php echo $this->Paginator->sort('mimetype'); ?></th>
															<th><?php echo $this->Paginator->sort('created'); ?></th>
															<th class="actions"><?php echo __('Ações'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($projects as $project): ?>
	<tr>
		<td><?php echo h($project['Project']['id']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['description']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($project['User']['name'], array('controller' => 'users', 'action' => 'view', $project['User']['id'])); ?>
		</td>
		<td><?php echo h($project['Project']['accepted']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['supervisor_description']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['filename']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['dir']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['filesize']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['mimetype']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Detalhar'), array('action' => 'view', $project['Project']['id']), array('class' => 'btn btn-default btn-xs')); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $project['Project']['id']), array('class' => 'btn btn-default btn-xs')); ?>
			<?php echo $this->Form->postLink(__('Apagar'), array('action' => 'delete', $project['Project']['id']), array('class' => 'btn btn-default btn-xs'), __('Tem certeza que deseja apagar este item? %s?', $project['Project']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
 
					</tbody>
				</table>
			</div><!-- /.table-responsive -->
			
			<p><small>
				<?php
				echo $this->Paginator->counter(array(
				'format' => __('Pagina {:page} de {:pages}')
				));
				?>			</small></p>

			<ul class="pagination">
				<?php
		echo $this->Paginator->prev('< ' . __('< Anterior'), array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
		echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'tag' => 'li', 'currentClass' => 'disabled'));
		echo $this->Paginator->next(__('Próximo >') . ' >', array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
	?>
			</ul><!-- /.pagination -->
			
		</div><!-- /.index -->
	
	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->
