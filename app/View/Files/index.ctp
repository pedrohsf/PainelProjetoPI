


<div id="page-container" class="row">

    <div id="page-content" class="col-sm-12">

        <form action="<?= $admLocal.$controller ?>/add " method="post" enctype="multipart/form-data">

            <h3>
                Enviar Novo Trabalho
            </h3>
            <label>Todos os trabalhos enviados vão passar por uma aprovação do supervisor. Somente arquivos .rar ou .zip de no máximo 20 MG.</label>
            <input type="file"  name="data[Update][filename]" />
            <textarea name="data[UpdateDescription][description]"></textarea>
            <input type="hidden" name="data[Update][mimetype]" />
            <input type="hidden" name="data[Update][dir]" />
            <input type="hidden" name="data[Update][filesize]" />

            <input style="margin-top:10px;" type="submit" value="Cadastrado" class="btn  btn-primary enviar_infos">
        </form>


    </div>
    <div id="page-content" class="col-sm-12">

        <div class="users index">

            <h2><?php echo __('Trabalhos Cadastrados'); ?></h2>

            <div class="table-responsive">
                <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
                    <thead>
                    <tr>

                        <th><?php echo $this->Paginator->sort('description','Descrição'); ?></th>
                        <th class="actions"><?php echo __('Ações'); ?></th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php  foreach ($files as $file): ?>
                        <tr>

                            <td><?php echo h($file['File']['description']); ?>&nbsp;</td>
                            <td class="actions col-sm-1">
                                <?php echo $this->Form->postLink(__('Apagar'), array('action' => 'delete', $file['File']['id']), array('class' => 'btn btn-default btn-xs'), __('Tem certeza que deseja apagar este skill com nome de %s?', $file['File']['id'])); ?>
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
</div>