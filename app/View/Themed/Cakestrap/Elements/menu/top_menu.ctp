

<nav class="navbar navbar-default" role="navigation">
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav" style="width:80%; margin: 0 auto !important; float:none !important;">
			<li   <?= ($controller === 'users')? 'class="active"' : '' ?> ><a href="<?= $admLocal ?>Users"><span class="glyphicon glyphicon-user"></span> Usuario</a></li>
			<li   <?= ($controller === 'files')? 'class="active"' : '' ?>><a href="<?= $admLocal ?>Files/"><span class="glyphicon glyphicon-book"></span> Trabalhos</a></li>
            <li   <?= ($controller === 'professionalexperiences')? 'class="active"' : '' ?>><a href="<?= $admLocal ?>ProfessionalExperiences/"><span class="glyphicon glyphicon-folder-open"></span> Experiências Profissional</a></li>



            <li style="float:right; " >
                <div class="btn-group" >
                    <button type="button" style=" padding: 0px; "  class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <?= $this->Html->image('avatar-120x120.png',array('style'=>'max-width:48px;' )); ?>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" data-toggle="modal" data-target="#imageModalChange" ><span class="glyphicon glyphicon-picture"></span> Trocar Imagem</a></li>
                        <li><a href="<?= $admLocal ?>Users/painelAluno""><span class="glyphicon glyphicon-user"></span> Usuario</a></li>
                        <li><a href="<?= $admLocal ?>Files/index""><span class="glyphicon glyphicon-book"></span> Trabalhos</a></li>
                        <li><a href="<?= $admLocal ?>ProfessionalExperiences/"><span class="glyphicon glyphicon-folder-open"></span> Experiências Profissional</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= $admLocal ?>Users/logout"><span class="glyphicon glyphicon-off"></span> Sair Do Painel</a></li>
                    </ul>
                </div>
           </li>

		</ul><!-- /.nav navbar-nav -->
	</div><!-- /.navbar-collapse -->
</nav><!-- /.navbar navbar-default -->

