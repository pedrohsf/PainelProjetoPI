


<div id="page-container" class="row">


    <?php echo $this->Html->tag('span','Listar', array('class' => 'btn btn-lg btn-info btn-listar')); ?>
    <?php echo $this->Html->tag('span','Cadastrar' ,array('class' => 'btn btn-lg btn-primary btn-cadastrar')); ?>

	<div id="page-content" class="col-sm-12 lista" >

        <div class="projects index">
		
			<h2><?php echo __('Projetos'); ?></h2>
			
			<div class="table-responsive">
				<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
					<thead>
						<tr>
                            <th class="col-sm-1"><?php echo $this->Paginator->sort('accepted','Projeto Aceito'); ?></th>
                            <th class="col-sm-2"><?php echo $this->Paginator->sort('filename','Nome'); ?></th>
                            <th class="col-sm-6"><?php echo $this->Paginator->sort('description','Descrição'); ?></th>
                            <th class="col-sm-1"><?php echo $this->Paginator->sort('created','Enviado Dia'); ?></th>
                            <th class="actions"><?php echo __('Ações'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($projects as $project): ?>
                            <tr>
                                <td>
                                    <?php echo $this->Html->image(
                                        ($project['Project']['accepted']) ? 'user_check.png' : 'user_cancel.png'
                                    ); ?> </td>
                                <td><?php echo h($project['Project']['filename']); ?>&nbsp;</td>
                                <td><?php echo h($project['Project']['description']); ?>&nbsp;</td>
                                <td><?php echo date('d/m/Y',strtotime($project['Project']['created'])); ?>&nbsp;</td>
                                <td class="actions">
                                    <?php if( (! $project['Project']['accepted'] ) AND (!empty($project['Project']['supervisor_description'])) ): ?>
                                        <?php echo $this->Html->link(__('Verificar Pendencia'), array('action' => 'view', $project['Project']['id']), array('class' => 'btn btn-default btn-xs')); ?>
                                    <?php endif; ?>
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
		echo $this->Paginator->next(__('Próximo >') . ' >', array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a')); ?>
			</ul><!-- /.pagination -->
			
		</div><!-- /.index -->
	
	</div><!-- /#page-content .col-sm-9 -->


    <div id="page-content" class="col-sm-12 cadastro" style="display: none;">

        <div class="projects form">

            <?php echo $this->Form->create('Project', array('action'=>'add','inputDefaults' => array('label' => false),'type'=>'file', 'role' => 'form')); ?>
            <fieldset>
                <h3><?php echo __('Cadastrar Novo Projeto'); ?></h3>
                <div class="form-group">
                    <?php echo $this->Form->label('description', 'Descrição');?>
                    <?php echo $this->Form->input('description', array('class' => 'form-control')); ?>
                </div><!-- .form-group -->

                <div class="form-group">
                    <?php echo $this->Form->label('filename', 'Envie um novo projeto compactado em .zip, todos os projetos enviados vão ser avaliados pelo supervisor.');?>
                    <?php echo $this->Form->input('filename', array('class' => 'form-control','type' => 'file')); ?>
                </div><!-- .form-group -->



            </fieldset>
            <?php echo $this->Form->submit('Enviar', array('class' => 'btn btn-large btn-primary')); ?>
            <?php echo $this->Form->end(); ?>

        </div><!-- /.form -->

    </div><!-- /#page-content .col-sm-9 -->



</div><!-- /#page-container .row-fluid -->
