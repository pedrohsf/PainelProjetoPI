<div id="page-container" class="row">

    <?php if(!empty($photoProposal)){ ?>
        <div id="page-content" class="col-sm-3  proposalPhotoPanel" >
            <ul class="list-group">
                <li class="list-group-item">
                    <?php if($changePhoto){ ?>
                        <div  style="display: table;margin:10px 0; width:100%;">
                            <a href="#" style="color:red;" data-toggle="modal" data-target="#imageModalChange" >Mudar proposta de foto para o perfil</a>
                        </div>
                    <?php }else{ ?>
                        <h5 class="linkerTitle">Foto em proposta</h5>
                    <?php } ?>

                    <?php
                    $img = explode('\\',$photoProposal['Photo']['dir']);
                    $img = implode('/',$img);
                    $img = $admLocal.$img.'/thumb/medio/'.$photoProposal['Photo']['filename'];
                    ?>
                    <img src="<?=$img?>"/>
                </li>
            </ul>
        </div>

    <?php } ?>



    <div id="page-content" class="col-sm-3">

        <ul class="list-group">
            <li class="list-group-item">
                <span class="badge"><?= count($usuario['Project']) ?></span>
                <?= $this->Html->link('Projetos',array('controller'=>'Projects','action'=>'index')); ?>
            </li>
            <li class="list-group-item">
                <span class="badge"><?= count($usuario['ProfessionalExperience']) ?></span>
                <?= $this->Html->link('Experiências Profissionais',array('controller'=>'ProfessionalExperiences','action'=>'index')); ?>
            </li>
            <li class="list-group-item">
                <span class="badge"><?= count($usuario['Formation']) ?></span>
                <?= $this->Html->link('Formações',array('controller'=>'Formations','action'=>'index')); ?>
            </li>
        </ul>

    </div>


    <div id="page-content" class="col-sm-12" style="float:left;">

        <ul class="list-group">
            <li class="list-group-item border-color-green">
                <a data-target="#modalSocialsAdd" data-toggle="modal" class="badge badge-success">+</a>

                <span style="font-weight:bolder; color: #004680;">Redes Sociais</span>
                <span class="legenda-soc">(</span>
                <?php echo $this->Html->image('user_check.png',array('style'=>'max-width:15px;')); ?>
                <span class="legenda-soc">Aceito</span>
                <?php echo $this->Html->image('user_cancel.png',array('style'=>'max-width:15px;')); ?>
                <span class="legenda-soc">Não avaliado ou requer mudança</span>
                <span class="legenda-soc">)</span>
            </li>
            <?php foreach($usuario['Social'] as $social){  ?>
                <li class="list-group-item border-color-green">

                        <?php echo $this->Html->image(
                            ($social['accepted']) ? 'user_check.png' : 'user_cancel.png'
                        ,array('style'=>'max-width:20px;')); ?>
                    <a target="_blank" href="<?="//".$social['link'] ?>"><?= ucfirst($social['type'])?></a>


                <?php
                $supervisor_description = $social['supervisor_description'];
                // verifica a existencia de >revisado< se ela já tiver sido revizado, essa tag vai existir no fim da string
                $description_revisado = stripos ($supervisor_description,">revisado<");
                if ($description_revisado !== false AND (!$social['accepted']) ){ ?>
                    <span style="color:green;"><?php echo __('Este link já foi revisado por você, esperando por nova avaliação do supervisor.'); ?></span>
                <?php }elseif(!empty($supervisor_description) AND !($social['accepted']) ) { ?>

                    <span style="color:red; font-weight: bolder;" >Requer mudança, menssagem do supervisor: <?= $social['supervisor_description']?></span>

                    <?php } ?>

                    <?= $this->Html->image('soc-'. ( ($social['type'] === 'google+') ? 'google' : $social['type'] ) .'.png',array('style'=>'max-width:20px; float:right;'));?>

                    <?php echo $this->Form->postLink(__('Apagar'), array('controller'=>'socials','action' => 'delete', $social['id']), array('style'=>'float:right; margin-right:1%;','class' => 'btn btn-default btn-xs'), __('Tem certeza que deseja apagar este link? %s', $social['link'])); ?>

                </li>
            <?php } ?>

        </ul>



    </div>





</div>