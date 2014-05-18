
<div id="page-container" class="row">

    <?php echo $this->Html->tag('span','Listar', array('class' => 'btn btn-lg btn-info btn-listar')); ?>
    <?php echo $this->Html->tag('span','Cadastrar' ,array('class' => 'btn btn-lg btn-primary btn-cadastrar')); ?>

    <div id="page-content" class="col-sm-12 lista">

        <div class="projects index">

            <h2><?php echo __('Formações'); ?></h2>

            <div class="table-responsive">
                <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th class="col-sm-2"><?php echo $this->Paginator->sort('acepted','Formação Aceita'); ?></th>
                        <th class="col-sm-6"><?php echo $this->Paginator->sort('description','Descrição'); ?></th>
                        <th class="actions"><?php echo __('Ações'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($formations as $formation): ?>
                        <tr>
                            <td>
                                <?php echo $this->Html->image(
                                    ($formation['Formation']['accepted']) ? 'user_check.png' : 'user_cancel.png'
                                ); ?> </td>
                            <td><?php echo h($formation['Formation']['description']); ?>&nbsp;</td>
                            <td class="actions">
                                <?php if( (! $formation['Formation']['accepted'] ) AND (!empty($formation['Formation']['supervisor_description'])) ): ?>
                                    <?php echo $this->Html->link(__('Verificar Pendencia'), array('action' => 'view', $formation['Formation']['id']), array('class' => 'btn btn-default btn-xs')); ?>
                                <?php endif; ?>
                                <?php echo $this->Form->postLink(__('Apagar'), array('action' => 'delete', $formation['Formation']['id']), array('class' => 'btn btn-default btn-xs'), __('Tem certeza que deseja apagar este item? %s?', $formation['Formation']['id'])); ?>
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

            <?php echo $this->Form->create('Formation', array('action'=>'add','inputDefaults' => array('label' => false), 'role' => 'form')); ?>
            <fieldset>
                <h3><?php echo __('Cadastrar Nova Formação'); ?></h3>
                <div class="form-group">
                    <?php echo $this->Form->label('description', 'Descrição');?>
                    <?php echo $this->Form->input('description', array('class' => 'form-control')); ?>
                </div><!-- .form-group -->

            </fieldset>
            <?php echo $this->Form->submit('Enviar', array('class' => 'btn btn-large btn-primary')); ?>
            <?php echo $this->Form->end(); ?>

        </div><!-- /.form -->

    </div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->
