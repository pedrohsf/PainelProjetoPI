
<?php echo $this->Html->docType('html5'); ?> 
<html>
	<head>
		<?php echo $this->Html->charset(); ?>

		 <title>Unipam SI</title>
		 
		<?php
			echo $this->Html->meta('icon');
			
			echo $this->fetch('meta');
			
			echo $this->Html->css('bootstrap.min');
			// Uncomment this to enable the bootstrap gradient theme (Flat is way better though).
			//echo $this->Html->css('bootstrap-theme.min');
			echo $this->Html->css('core');
			echo $this->Html->css('style');
            echo $this->Html->css('ion.tabs');
            echo $this->Html->css('ion.tabs.skinFlat');
			echo $this->fetch('css');
			
			echo $this->Html->script('libs/jquery-1.10.2.min');
			echo $this->Html->script('libs/bootstrap.min');
            echo $this->Html->script('ion.tabs.min.js');
            echo $this->Html->script('abasCadastrarListar.js');
			echo $this->fetch('script');
		?>
		
	</head>

	


    <body id="body_do_site">

		<div class="navbar" style="position:relative;z-index: 1;">
			<div class="navbar-inner margin-menu">
				<div class="container text-center ">
			 
				  
				  <img    src="<?= $admLocal ?>img/logo_unipam.png"   class="img-rounded unipam_logo"  />
				  <div class="container">
						<a class="btn btn-info btn-mini botao_aluno " href="index.html"><i class="icon-globe icon-white"></i> Voltar ao site </a>
				  </div>
				  
			 
				</div>
			
			</div>
            <?php if($logado): ?>

            <div id="main-container">

                <?php  echo $this->element('menu/top_menu'); ?>

            </div>
            <?php endif;?>
			<div id="content" class="container">

				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div><!-- /#header .container -->
			
			<div id="footer" class="container">
				<?php //Silence is golden ?>
			</div><!-- /#footer .container -->
			
		</div><!-- /#main-container -->


        <?php /*
		<div class="container">
			<div class="well well-sm">
				<small>
					<?php echo $this->element('sql_dump'); ?>
				</small>
			</div><!-- /.well well-sm -->
		</div><!-- /.container -->

        */ ?>


        <!-- Modal Image User Change -->
        <div class="modal fade" id="imageModalChange" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-picture"></span> Trocar imagem sua imagem</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" action="<?= $admLocal ?>Photos/add/<?= $controller."/".$action ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputFile">Envie uma imagem.</label>
                                <input type="file" id="exampleInputFile" name="data[Photo][filename]">
                                <p class="help-block">Sua imagem deve conter apenas você, com roupas formais, ela vai ser avaliada por um supervisor.</p>
                                <p class="help-block">Tamanho Máximo: EX:MG Tipos aceitos : .jpg , .png , .jpeg</p>
                            </div>

                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-cloud-upload"></span> Atualizar Imagem !</button>
                        </form>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fim Modal Image User Change -->


        <?php if($controller === 'updates'){ ?>


            <!-- Modal Update changes-->
            <div class="modal fade" id="modalUpdateSupervisorDescription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Enviar aviso para <b></b></h4>
                        </div>
                        <div class="modal-body">
                            <form id="formSupervisorDescriptionUpdate" method="post" action="" >
                            <textarea style="min-width:100%; min-height: 200px; padding: 5px; max-width: 100%;" name="data[Info]"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"">Enviar</button>

                            </form>
                            <button type="button" class="btn btn-danger"  data-dismiss="modal" >Cancelar</button>

                        </div>
                    </div>
                </div>
            </div>



        <?php } ?>


        <?php if( ($controller === 'users') AND (!$supervisor) ) { ?>

            <div class="modal fade" id="modalSocialsAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Cadastro/Edição de Rede Social</h4>
                        </div>
                        <div class="modal-body">
                            <?php echo $this->Form->create('Social',array('controller'=>'socials','action'=>'add'), array('inputDefaults' => array('label' => false), 'role' => 'form')); ?>
                            <div class="form-group">
                                <?= $this->Form->input('type',array('label'=>'Tipo','class' => 'form-control','options'=>array('facebook'=>'Facebook','twitter'=>'Twitter','google+'=>'Google +','linkdin'=>'LinkDin'))); ?>
                            </div>
                            <div class="form-group">
                                <?= $this->Form->input('link',array('class' => 'form-control')); ?>
                            </div>
                        </div>

                        <div class="modal-footer" >

                            <button type="submit" class="btn btn-primary"">Enviar</button>

                            </form>
                            <button type="button" class="btn btn-danger"  data-dismiss="modal" >Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>


	</body>

</html>