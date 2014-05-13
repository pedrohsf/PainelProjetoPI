<div class="ionTabs" id="tabs_1" data-name="Tabs_Group_name">
    <ul class="ionTabs__head">
        <li class="ionTabs__tab" data-target="images">Imagens</li>
        <li class="ionTabs__tab" data-target="projects">Projetos</li>
        <li class="ionTabs__tab" data-target="professionalExperiences">Experiências Profissionais</li>
        <li class="ionTabs__tab" data-target="formations">Formações</li>
    </ul>
    <div class="ionTabs__body">
        <div class="ionTabs__item" data-name="images">
            <div id="page-content" class="col-sm-12">

                <div class="index">


                    <div class="table-responsive">
                        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="col-sm-1"><?php echo ('Atual'); ?></th>
                                <th class="col-sm-2"><?php echo ('Proposta'); ?></th>
                                <th class="col-sm-1"><?php echo ('Enviado Dia'); ?></th>
                                <th class="actions"><?php echo __('Ações'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($photos as $photo): ?>
                                <tr>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td><?php echo date('d/m/Y',strtotime($photo['Photo']['created'])); ?>&nbsp;</td>
                                    <td class="actions">
                                        <?php echo $this->Form->postLink(__('Aceitar'), array('action' => 'acceptProject', $photo['Photo']['id']), array('class' => 'btn btn-default btn-xs')); ?>
                                        <?php echo $this->Html->link(__('Solicitar Mudança'), array('action' => 'view', $photo['Photo']['id']), array('class' => 'btn btn-default btn-xs')); ?>
                                        <?php echo $this->Form->postLink(__('Apagar'), array('action' => 'delete', $photo['Photo']['id']), array('class' => 'btn btn-default btn-xs'), __('Tem certeza que deseja apagar este item? %s?', $photo['Photo']['id'])); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div><!-- /.table-responsive -->



                </div><!-- /.index -->

            </div><!-- /#page-content .col-sm-9 -->
        </div>
        <div class="ionTabs__item" data-name="projects">

            <div id="page-container" class="row">


                <div id="page-content" class="col-sm-12">

                    <div class="index">


                        <div class="table-responsive">
                            <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="col-sm-1"><?php echo ('Aluno'); ?></th>
                                    <th class="col-sm-2"><?php echo ('Nome'); ?></th>
                                    <th class="col-sm-6"><?php echo ('Descrição'); ?></th>
                                    <th class="col-sm-1"><?php echo ('Enviado Dia'); ?></th>
                                    <th class="actions"><?php echo __('Ações'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($projects as $project): ?>
                                    <tr>
                                        <td>
                                            <?= $this->Html->link($project['User']['name'],array('controller'=>'users','action'=>'view',$project['User']['id']),array('target'=>'_blank'));?>
                                        </td>
                                        <td><?php echo h($project['Project']['filename']); ?>&nbsp;</td>
                                        <td><?php echo h($project['Project']['description']); ?>&nbsp;</td>
                                        <td><?php echo date('d/m/Y',strtotime($project['Project']['created'])); ?>&nbsp;</td>
                                        <td class="actions">
                                            <?php echo $this->Form->postLink(__('Aceitar'), array('action' => 'acceptProject', $project['Project']['id']), array('class' => 'btn btn-default btn-xs')); ?>
                                            <?php echo $this->Html->link(__('Solicitar Mudança'), array('action' => 'view', $project['Project']['id']), array('class' => 'btn btn-default btn-xs btn-project','data-toggle'=>"modal", "onclick"=>"modalSupervisorDescriptionTitle(\"".$project['User']['name']."\" )",'data-target'=>"#modalUpdateSupervisorDescription")); ?>
                                            <?php echo $this->Form->postLink(__('Apagar'), array('action' => 'delete', $project['Project']['id']), array('class' => 'btn btn-default btn-xs'), __('Tem certeza que deseja apagar este item? %s?', $project['Project']['id'])); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div><!-- /.table-responsive -->



                    </div><!-- /.index -->

                </div><!-- /#page-content .col-sm-9 -->



            </div>
        </div>

        <div class="ionTabs__item" data-name="professionalExperiences">

            <div id="page-container" class="row">


                <div id="page-content" class="col-sm-12">

                    <div class="index">


                        <div class="table-responsive">
                            <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="col-sm-1"><?php echo ('Aluno'); ?></th>
                                    <th class="col-sm-6"><?php echo ('Descrição'); ?></th>
                                    <th class="col-sm-1"><?php echo ('Enviado Dia'); ?></th>
                                    <th class="actions"><?php echo __('Ações'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($professionalExperiences as $professionalExperience): ?>
                                    <tr>
                                        <td>
                                            <?= $this->Html->link($professionalExperience['User']['name'],array('controller'=>'users','action'=>'view',$professionalExperience['User']['id']),array('target'=>'_blank'));?>
                                        </td>
                                        <td><?php echo h($professionalExperience['ProfessionalExperience']['description']); ?>&nbsp;</td>
                                        <td><?php echo date('d/m/Y',strtotime($professionalExperience['ProfessionalExperience']['created'])); ?>&nbsp;</td>
                                        <td class="actions">
                                            <?php echo $this->Form->postLink(__('Aceitar'), array('action' => 'acceptProfessionalExperience', $professionalExperience['ProfessionalExperience']['id']), array('class' => 'btn btn-default btn-xs')); ?>
                                            <?php echo $this->Html->link(__('Solicitar Mudança'), array('action' => 'view', $professionalExperience['ProfessionalExperience']['id']), array('class' => 'btn btn-default btn-xs btn-professionalExperience','data-toggle'=>"modal", "onclick"=>"modalSupervisorDescriptionTitle(\"".$professionalExperience['User']['name']."\" )",'data-target'=>"#modalUpdateSupervisorDescription")); ?>
                                            <?php echo $this->Form->postLink(__('Apagar'), array('action' => 'delete', $professionalExperience['ProfessionalExperience']['id']), array('class' => 'btn btn-default btn-xs'), __('Tem certeza que deseja apagar este item? %s?', $professionalExperience['ProfessionalExperience']['id'])); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div><!-- /.table-responsive -->



                    </div><!-- /.index -->

                </div><!-- /#page-content .col-sm-9 -->



            </div>

        </div>
        <div class="ionTabs__item" data-name="formations">
            <div id="page-container" class="row">


                <div id="page-content" class="col-sm-12">

                    <div class="index">


                        <div class="table-responsive">
                            <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="col-sm-1"><?php echo ('Aluno'); ?></th>
                                    <th class="col-sm-6"><?php echo ('Descrição'); ?></th>
                                    <th class="col-sm-1"><?php echo ('Enviado Dia'); ?></th>
                                    <th class="actions"><?php echo __('Ações'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($formations as $formation): ?>
                                    <tr>
                                        <td>
                                            <?= $this->Html->link($formation['User']['name'],array('controller'=>'users','action'=>'view',$formation['User']['id']),array('target'=>'_blank'));?>
                                        </td>
                                        <td><?php echo h($formation['Formation']['description']); ?>&nbsp;</td>
                                        <td><?php echo date('d/m/Y',strtotime($formation['Formation']['created'])); ?>&nbsp;</td>
                                        <td class="actions">
                                            <?php echo $this->Form->postLink(__('Aceitar'), array('action' => 'acceptFormation', $formation['Formation']['id']), array('class' => 'btn btn-default btn-xs')); ?>
                                            <?php echo $this->Html->link(__('Solicitar Mudança'), array('action' => 'view', $formation['Formation']['id']), array('class' => 'btn btn-default btn-xs btn-formation','data-toggle'=>"modal", "onclick"=>"modalSupervisorDescriptionTitle(\"".$formation['User']['name']."\" )",'data-target'=>"#modalUpdateSupervisorDescription")); ?>
                                            <?php echo $this->Form->postLink(__('Apagar'), array('action' => 'delete', $formation['Formation']['id']), array('class' => 'btn btn-default btn-xs'), __('Tem certeza que deseja apagar este item? %s?', $formation['Formation']['id'])); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div><!-- /.table-responsive -->



                    </div><!-- /.index -->

                </div><!-- /#page-content .col-sm-9 -->



            </div>
        </div>

        <div class="ionTabs__preloader"></div>
    </div>
</div>

<script type="text/javascript">
    $.ionTabs("#tabs_1, #tabs_2, #tabs_3",{
        type : 'storage'
    });

</script>


