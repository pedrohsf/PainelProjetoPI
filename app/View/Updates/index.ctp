

<?= $this->Html->css('shadowBox/shadowbox'); ?>
<?= $this->Html->script('shadowbox.js'); ?>
<script type="text/javascript">
    Shadowbox.init({
        handleOversize: "drag",
        modal: false

    });



</script>

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
                                <th class="col-sm-2"><?php echo ('Proposta'); ?></th>
                                <th class="col-sm-1"><?php echo ('Enviado Dia'); ?></th>
                                <th class="actions"><?php echo __('Ações'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($photos as $photo): ?>
                                <?php
                                $supervisor_description = $photo['Photo']['supervisor_description'];
                                // verifica a existencia de >revisado< se ela já tiver sido revizado, se já, então ele vai conter algo diferente de false
                                $description_revisado = stripos ($supervisor_description,">revisado<");
                                ?>
                                <tr
                                    <?php if(!empty($supervisor_description)){ ?>
                                        style="<?= ($description_revisado !== false)? 'color:blue;' : 'color:red;' ?>"
                                    <?php } ?>
                                >
                                    <?php
                                        $photo['Photo']['dir'] = explode("\\",$photo['Photo']['dir']);
                                        $photo['Photo']['dir'] = implode("/",$photo['Photo']['dir']);
                                        $imgPequena= $admLocal.$photo['Photo']['dir']."/thumb/pequena/".$photo['Photo']['filename'];
                                        $imgLocal = $admLocal.$photo['Photo']['dir']."/".$photo['Photo']['filename'];
                                    ?>
                                    <td>
                                        <a href="<?= $imgLocal ?>" rel="shadowbox" title="<?=$photo['Photo']['filename'] ?>">
                                            <img style="<?php echo ($description_revisado === false AND !empty($supervisor_description)) ? 'border:1px red solid' : '' ?> " src="<?=$imgPequena?>" title="<?=$photo['Photo']['filename'] ?>" />
                                        </a>
                                        <?= ($description_revisado === false AND !empty($supervisor_description) )? "<p><i> (OBS: $supervisor_description) </i></p>" : "";  ?>
                                    </td>
                                    <td><?php echo date('d/m/Y',strtotime($photo['Photo']['created'])); ?>&nbsp;</td>
                                    <td class="actions">
                                        <?php echo $this->Form->postLink(__('Aceitar'), array('action' => 'accept_photo', $photo['Photo']['id']), array('class' => 'btn btn-default btn-xs')); ?>
                                        <?php echo $this->Html->link(__('Solicitar Mudança'), array('action' => 'view', $photo['Photo']['id']), array('class' => 'btn btn-default btn-xs btn-photo','data-toggle'=>"modal", "onclick"=>"modalSupervisorDescriptionTitle(\"".$photo['User']['name']."\" )",'data-target'=>"#modalUpdateSupervisorDescription")); ?>
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
                                    <th class="col-sm-2"><?php echo ('Arquivo'); ?></th>
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
                                        <?php
                                        // reverte as barras de endereço do arquivo para usar na url
                                            $project['Project']['dir'] = explode("\\",$project['Project']['dir']);
                                            $project['Project']['dir'] = implode("/",$project['Project']['dir']);
                                            $arquiveLocate = $admLocal.$project['Project']['dir']."/".$project['Project']['filename'];
                                        ?>
                                        <td> <a target="_blank" href="<?=$arquiveLocate?>"> <?= $project['Project']['filename'] ?> </a> &nbsp;</td>
                                        <td><?php echo h($project['Project']['description']); ?>&nbsp;</td>
                                        <td><?php echo date('d/m/Y',strtotime($project['Project']['created'])); ?>&nbsp;</td>
                                        <td class="actions">
                                            <?php echo $this->Form->postLink(__('Aceitar'), array('action' => 'accept_project', $project['Project']['id']), array('class' => 'btn btn-default btn-xs')); ?>
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
                                    <?php
                                        $supervisor_description = $professionalExperience['ProfessionalExperience']['supervisor_description'];
                                        // verifica a existencia de >revisado< se ela já tiver sido revizado, se já, então ele vai conter algo diferente de false
                                        $description_revisado = stripos ($supervisor_description,">revisado<");
                                    ?>
                                    <tr
                                    <?php if(!empty($professionalExperience['ProfessionalExperience']['supervisor_description'])){ ?>
                                        style="<?= ($description_revisado !== false)? 'color:blue;' : 'color:red;' ?>"
                                    <?php } ?>
                                    >

                                        <td>
                                            <?= $this->Html->link($professionalExperience['User']['name'],array('controller'=>'users','action'=>'view',$professionalExperience['User']['id']),array('target'=>'_blank'));?>
                                        </td>
                                        <td><?= h($professionalExperience['ProfessionalExperience']['description']) ?> <?= ($description_revisado === false AND !empty($supervisor_description) )? "<i> (OBS: $supervisor_description) </i>" : "";  ?>&nbsp;</td>
                                        <td><?php echo date('d/m/Y',strtotime($professionalExperience['ProfessionalExperience']['created'])); ?>&nbsp;</td>
                                        <td class="actions">
                                            <?php echo $this->Form->postLink(__('Aceitar'), array('action' => 'accept_professional_experience', $professionalExperience['ProfessionalExperience']['id']), array('class' => 'btn btn-default btn-xs')); ?>
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
                                    <?php
                                    $supervisor_description = $formation['Formation']['supervisor_description'];
                                    // verifica a existencia de >revisado< se ela já tiver sido revizado, se já, então ele vai conter algo diferente de false
                                    $description_revisado = stripos ($supervisor_description,">revisado<");
                                    ?>
                                    <tr
                                        <?php if(!empty($formation['Formation']['supervisor_description'])){ ?>
                                            style="<?= ($description_revisado !== false)? 'color:blue;' : 'color:red;' ?>"
                                        <?php } ?>
                                    >
                                        <td>
                                            <?= $this->Html->link($formation['User']['name'],array('controller'=>'users','action'=>'view',$formation['User']['id']),array('target'=>'_blank'));?>
                                        </td>
                                        <td><?php echo h($formation['Formation']['description']); ?> <?= ($description_revisado === false AND !empty($supervisor_description) )? "<i> (OBS: $supervisor_description) </i>" : "";  ?>&nbsp;</td>
                                        <td><?php echo date('d/m/Y',strtotime($formation['Formation']['created'])); ?>&nbsp;</td>
                                        <td class="actions">
                                            <?php echo $this->Form->postLink(__('Aceitar'), array('action' => 'accept_formation', $formation['Formation']['id']), array('class' => 'btn btn-default btn-xs')); ?>
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

        <p> <b>Legenda:</b> <span style="color:red">(Supervisor solicitou Mudança) </span> : <span style="color:blue">(Aluno verificou pendência e reenviou informação)</span> : (Ainda não verificado pelo supervisor) </p>
    </div>
</div>

<script type="text/javascript">
    $.ionTabs("#tabs_1, #tabs_2, #tabs_3",{
        type : 'storage'
    });

</script>



<script type="text/javascript">

    $('.btn-formation').click(function(){

        modalSupervisorDescriptionLink(getIdItem(this),"Formation");

    });

    $('.btn-professionalExperience').click(function(){

        modalSupervisorDescriptionLink(getIdItem(this),"ProfessionalExperience");

    });

    $('.btn-project').click(function(){

        modalSupervisorDescriptionLink(getIdItem(this),"Project");

    });

    $('.btn-photo').click(function(){

        modalSupervisorDescriptionLink(getIdItem(this),"Photo");

    });

    function getIdItem(objeto){
        var item = objeto.toString();
        var item = item.split("/");
        var id = item[item.length-1];
        return id;
    }

    function modalSupervisorDescriptionLink(id,type){

        $("#formSupervisorDescriptionUpdate").attr("action", "<?= $admLocal ?>Updates/description_update/" + id + "/" + type );

    }

    function modalSupervisorDescriptionTitle(name){

        $("#modalUpdateSupervisorDescription #myModalLabel b").text(
            name
        );
    }



</script>
