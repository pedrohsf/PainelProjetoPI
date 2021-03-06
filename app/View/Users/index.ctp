
<div id="page-container" class="row">

	
	<div id="page-content" class="col-sm-12">

		<div class="users index">
		
			<h2><?php echo __('Usuários'); ?></h2>
			
			<div class="table-responsive">
				<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
					<thead>
						<tr>

                            <th><?php echo $this->Paginator->sort('accepted','Aceito'); ?></th>
                            <th><?php echo $this->Paginator->sort('name','Nome'); ?></th>
                            <th><?php echo $this->Paginator->sort('email','E-Mail'); ?></th>
                            <th><?php echo $this->Paginator->sort('modified','Ultima Modificação'); ?></th>
                            <th class="actions"><?php echo __('Ações'); ?></th>

						</tr>
					</thead>
					<tbody>
                    <?php  foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $this->Html->image(
                                    ($user['User']['accepted']) ? 'user_check.png' : 'user_cancel.png'
                                ); ?> </td>
                            <td><?php echo utf8_encode($user['User']['name']); ?>&nbsp;</td>
                            <td><?php echo utf8_encode($user['User']['email']); ?>&nbsp;</td>
                            <td><?php echo utf8_encode(date('d-m-Y',strtotime($user['User']['modified']))); ?>&nbsp;</td>
                            <td class="actions">
                                <?php echo $this->Html->link(__('Detalhar'), array('action' => 'view', $user['User']['id']), array('class' => 'btn btn-default btn-xs')); ?>
                                <?php echo $this->Form->postLink(__('Apagar'), array('action' => 'delete', $user['User']['id']), array('class' => 'btn btn-default btn-xs'), __('Tem certeza que deseja apagar este item? %s?', $user['User']['id'])); ?>
                                <?php if($user['User']['accepted']): ?>
                                    <?php echo $this->Html->link(__('Bloquear Registro'), array('action' => 'bloquearRegistro', $user['User']['id']), array('class' => 'btn btn-default btn-xs')); ?>
                                <?php else: ?>
                                    <?php echo $this->Html->link(__('Liberar Registro'), array('action' => 'liberarRegistro', $user['User']['id']), array('class' => 'btn btn-default btn-xs')); ?>
                                <?php endif; ?>
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
