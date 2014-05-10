<div id="page-container" class="row">


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