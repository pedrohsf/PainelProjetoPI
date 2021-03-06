

<nav class="navbar navbar-default" role="navigation">
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav" style="width:80%; margin: 0 auto !important; float:none !important;">

            <?php if($supervisor): ?>
                <li   <?= ($controller === 'users')? 'class="active"' : '' ?> ><a href="<?= $admLocal ?>Users/index"><span class="glyphicon glyphicon-list"></span> Requerimento de usuários</a></li>
                <li   <?= ($controller === 'updates')? 'class="active"' : '' ?> ><a href="<?= $admLocal ?>Updates/index"><span class="glyphicon glyphicon-globe"></span> Requisições de atualizações</a></li>
                <li   <?= ($controller === 'skills')? 'class="active"' : '' ?> ><a href="<?= $admLocal ?>Skills/index"><span class="glyphicon glyphicon-cog"></span> Skills</a></li>
                <li><a href="<?= $admLocal ?>Users/logout"><span class="glyphicon glyphicon-off"></span> Sair Do Painel</a></li>
            <?php else: ?>
                <li   <?= ($controller === 'users')? 'class="active"' : '' ?> ><a href="<?= $admLocal ?>Users/painel_aluno"><span class="glyphicon glyphicon-user"></span> Usuário</a></li>
                <li   <?= ($controller === 'projects')? 'class="active"' : '' ?>><a href="<?= $admLocal ?>Projects/"><span class="glyphicon glyphicon-book"></span> Projetos</a></li>
                <li   <?= ($controller === 'professionalexperiences')? 'class="active"' : '' ?>><a href="<?= $admLocal ?>ProfessionalExperiences/"><span class="glyphicon glyphicon-folder-open"></span> Experiências Profissional</a></li>
                <li   <?= ($controller === 'formations')? 'class="active"' : '' ?>><a href="<?= $admLocal ?>Formations/"><span class="glyphicon glyphicon-globe"></span> Formações</a></li>
            <?php endif; ?>

            <?php if(!$supervisor) : ?>
            <li style="float:right; " >
                <div class="btn-group" >
                    <button type="button" style=" padding: 0px; "  class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <?php if(!empty($photo)){
                        $img = explode('\\',$photo['Photo']['dir']);
                        $img = implode('/',$img);
                        $img = $admLocal.$img.'/thumb/mini/'.$photo['Photo']['filename'];
                        ?>
                        <img src="<?=$img?>" alt=""/>
                    <?php }
                    else{ ?>
                            <?= $this->Html->image('avatar-120x120.png',array('style'=>'max-width:48px;' )); ?>
                    <?php } ?>
                    </button>
                    <ul class="dropdown-menu" role="menu">

                            <li><a href="#" data-toggle="modal" data-target="#imageModalChange" ><span class="glyphicon glyphicon-picture"></span> Trocar Imagem</a></li>
                            <li><a href="<?= $admLocal ?>Users/painel_aluno""><span class="glyphicon glyphicon-user"></span> Usuário</a></li>
                            <li><a href="<?= $admLocal ?>Projects/index""><span class="glyphicon glyphicon-book"></span> Projetos</a></li>
                            <li><a href="<?= $admLocal ?>ProfessionalExperiences/"><span class="glyphicon glyphicon-folder-open"></span> Experiências Profissional</a></li>
                        <li   <?= ($controller === 'formations')? 'class="active"' : '' ?>><a href="<?= $admLocal ?>Formations/"><span class="glyphicon glyphicon-globe"></span> Formações</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= $admLocal ?>Users/logout"><span class="glyphicon glyphicon-off"></span> Sair Do Painel</a></li>
                    </ul>
                </div>
           </li>
           <?php endif; ?>

		</ul><!-- /.nav navbar-nav -->
	</div><!-- /.navbar-collapse -->
</nav><!-- /.navbar navbar-default -->

