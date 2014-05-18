


    <div id="page-container" class="row">

        <?php echo $this->Html->tag('span','Listar', array('class' => 'btn btn-lg btn-info btn-listar')); ?>
        <?php echo $this->Html->tag('span','Cadastrar' ,array('class' => 'btn btn-lg btn-primary btn-cadastrar')); ?>

        <div id="page-content" class="col-sm-12 lista">

            <div class="users index">

                <h2><?php echo __('Skills Cadastrados'); ?></h2>

                <div class="table-responsive">
                    <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
                        <thead>
                        <tr>

                            <th><?php echo $this->Paginator->sort('name','Nome'); ?></th>
                            <th class="actions"><?php echo __('Ações'); ?></th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php  foreach ($skills as $skill): ?>
                            <tr>

                                <td><?php echo h($skill['Skill']['name']); ?>&nbsp;</td>
                                <td class="actions col-sm-1">
                                    <?php echo $this->Form->postLink(__('Apagar'), array('action' => 'delete', $skill['Skill']['id']), array('class' => 'btn btn-default btn-xs'), __('Tem certeza que deseja apagar este skill com nome de %s?', $skill['Skill']['name'])); ?>
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

        </div>


        <div id="page-content" class="col-sm-12 cadastro" style="display: none;">

            <form action="<?= $admLocal.$controller ?>/add " method="post">

                <h3>
                    Novo Skill
                </h3>
                <input type="text"  name="data[Skill][name]">
                <input type="submit" value="Cadastrar" class="btn  btn-primary enviar_infos">
            </form>


        </div>

    </div>