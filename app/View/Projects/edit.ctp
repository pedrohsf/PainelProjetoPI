
<div id="page-container" class="row">


	
	<div id="page-content" class="col-sm-12">

		<div class="projects form">
			
			<?php echo $this->Form->create('Project', array('inputDefaults' => array('label' => false), 'role' => 'form')); ?>
				<fieldset>
                    <h2><?php echo __('Reenviar Projeto'); ?></h2>

                    <div class="form-group">
                            <?php echo $this->Form->input('id', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                        <?php echo $this->Form->label('description', 'Descrição');?>
                            <?php echo $this->Form->input('description', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                        <?php echo $this->Form->label('filename', 'Envie um novo projeto compactado em .zip ou .rar, todos os projetos enviados vão ser avaliados pelo supervisor, se for mudar apenas o texto não precisa enviar arquivo.');?>
                            <?php echo $this->Form->input('filename', array('class' => 'form-control','type' => 'file')); ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                            <?php echo $this->Form->input('dir', array('class' => 'form-control','type' => 'hidden')); ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                            <?php echo $this->Form->input('filesize', array('class' => 'form-control','type' => 'hidden')); ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                            <?php echo $this->Form->input('mimetype', array('class' => 'form-control','type' => 'hidden')); ?>
                    </div><!-- .form-group -->

				</fieldset>
			<?php echo $this->Form->submit('Reenviar', array('class' => 'btn btn-large btn-primary')); ?>
<?php echo $this->Form->end(); ?>
			
		</div><!-- /.form -->
			 
	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->
