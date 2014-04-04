

<style type="text/css">



</style>


<div id="page-container" class="row">

	<div id="sidebar" class="col-sm-3">
		
		<div class="actions">
		
			<ul class="list-group">
										<li class="list-group-item"><?php echo $this->Html->link(__('Listar Users'), array('action' => 'index')); ?></li>
							</ul><!-- /.list-group -->
		
		</div><!-- /.actions -->
		
	</div><!-- /#sidebar .col-sm-3 -->
	
<div id="page-content" class="col-sm-9">

    <div class="users form">
			
        <?php echo $this->Form->create('User', array('inputDefaults' => array('label' => false), 'role' => 'form')); ?>
                <fieldset>
                            <h2><?php echo __('Cadastrar Usuário'); ?></h2>
                    <div class="form-group">
                        <?php echo $this->Form->label('Apelido');?>
                            <?php echo $this->Form->input('username', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                        <?php echo $this->Form->label('Senha');?>
                            <?php echo $this->Form->input('password', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                        <?php echo $this->Form->label('Regra');?>
                            <?php echo $this->Form->input('role', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                        <?php echo $this->Form->label('Nome');?>
                            <?php echo $this->Form->input('name', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                        <?php echo $this->Form->label('E-Mail');?>
                            <?php echo $this->Form->input('email', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                            <?php echo $this->Form->input('accepted', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                        <?php echo $this->Form->label('Objetivo (Meta que você deseja alcançar com o curso)');?>
                            <?php echo $this->Form->input('goal', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                        <?php echo $this->Form->label('Telefone');?>
                            <?php echo $this->Form->input('telephone', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                        <label for="UserCep">Cep</label>
                            <div class="input text"><input name="data[User][Address][cep]" class="form-control" type="text" id="UserCep">
                            <button id='btn btn-small'>Busca Endereço</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="UserCep">Rua</label>
                            <div class="input text"><input name="data[User][Address][street]" disabled class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="UserCep">Bairro</label>
                            <div class="input text"><input name="data[User][Neighborhood][name]" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="UserCep">Cidade</label>
                            <div class="input text"><input name="data[User][City][name]" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="UserCep">Estado</label>
                            <input name="data[User][State][name]" class="form-control"  type="text">
                            <input name="data[User][State][acronym]" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="UserCep">Número</label>
                        <div class="input text"><input name="data[User][Address][number]" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="UserCep">Complemento</label>
                        <div class="input text"><input name="data[User][Address][complement]" class="form-control" type="text">
                        </div>
                    </div>

                </fieldset>
            <?php echo $this->Form->submit('Enviar', array('class' => 'btn btn-large btn-primary')); ?>
        <?php echo $this->Form->end(); ?>
			
		</div><!-- /.form -->
			 
	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->
