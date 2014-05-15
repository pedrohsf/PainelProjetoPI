<div id="page-container" class="row">

    <?php if(!empty($photoProposal)){ ?>
        <div id="page-content" class="col-sm-3 list-group-item proposalPhotoPanel" >
            <?php if($changePhoto){ ?>
                <div style="display: table;margin:10px 0; width:100%;">
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

</div>