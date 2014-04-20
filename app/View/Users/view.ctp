
<div id="page-container" class="row">

	<div id="sidebar" class="col-sm-3">
		
		<div class="actions">
			
			<ul class="list-group">			
                <li class="list-group-item"><?php echo $this->Form->postLink(__('Apagar User'), array('action' => 'delete', $user['User']['id']), array('class' => ''), __('Tem certeza que deseja apagar este item? %s', $user['User']['id'])); ?> </li>
                <?php if($user['User']['accepted']): ?>
                    <li  class="list-group-item">
                        <?php echo $this->Html->link(__('Bloquear Registro'), array('action' => 'bloquearRegistro', $user['User']['id'],true), array('class' => '')); ?>
                    </li>
                <?php else: ?>
                    <li  class="list-group-item">
                        <?php echo $this->Html->link(__('Liberar Registro'), array('action' => 'liberarRegistro', $user['User']['id'],true), array('class' => '')); ?>
                    </li>
                <?php endif; ?>
			</ul><!-- /.list-group -->
			
		</div><!-- /.actions -->
		
	</div><!-- /#sidebar .span3 -->
	
	<div id="page-content" class="col-sm-9">
		
		<div class="users view">

			<h2><?php  echo __('Usuário ' . h($user['User']['name'])); ?></h2>
			
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tbody>
						<tr>
                            <td><strong><?php echo __('Id'); ?></strong></td>
                            <td>
                                <?php echo h($user['User']['id']); ?>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><strong><?php echo __('Apelido'); ?></strong></td>
                            <td>
                                <?php echo h($user['User']['username']); ?>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><strong><?php echo __('Regra De Acesso'); ?></strong></td>
                            <td>
                                <?php echo h($user['User']['role']); ?>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><strong><?php echo __('E-Mail'); ?></strong></td>
                            <td>
                                <?php echo h($user['User']['email']); ?>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><strong><?php echo __('Aceito'); ?></strong></td>
                            <td>
                                <?php echo $this->Html->image(
                                    ($user['User']['accepted']) ? 'user_check.png' : 'user_cancel.png'
                                ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong><?php echo __('Objetivo'); ?></strong></td>
                            <td>
                                <?php echo h($user['User']['goal']); ?>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><strong><?php echo __('Telefone'); ?></strong></td>
                            <td>
                                <?php echo h($user['User']['telephone']); ?>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><strong><?php echo __('Criado Dia'); ?></strong></td>
                            <td>
                                <?php echo date('d/m/Y',strtotime($user['User']['created'])); ?>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><strong><?php echo __('Ultima Modificação'); ?></strong></td>
                            <td>
                                <?php echo date('d/m/Y',strtotime($user['User']['modified'])); ?>
                                &nbsp;
                            </td>
                        </tr>

                    </tbody>
                </table><!-- /.table table-striped table-bordered -->
            </div><!-- /.table-responsive -->
			
		</div><!-- /.view -->

			
	</div><!-- /#page-content .span9 -->

</div><!-- /#page-container .row-fluid -->
