

<style type="text/css">


    .form_endereco .rua{

        width:50%;

        float:left;
    }
    .form_endereco .form-group{
        width:50%;
        min-height:100px;
    }
    .form_endereco .bairro{
        float:right;
        width:50%;

    }
    .form_endereco * label{
        width:100%;
    }
    .form_endereco *{
        float:left;
        width:99%;

    }
    .form_endereco .estado input{
        width:50%;
    }
    .numero{
        float:left;
        width:49%;
        margin-right:1%;
    }
    .complemento{
        float:left;
        width:50%;
    }
    .cancelar_infos{
        float:right;
    }
    .enviar_infos{
        float:left;
    }
    .botao_infos{
        margin:50px 0;
    }
</style>


<div id="page-container" class="row">


	
<div id="page-content" class="col-sm-12">

    <div class="users form">
			
        <?php echo $this->Form->create('User', array('inputDefaults' => array('label' => false), 'role' => 'form','accept-charset'=>'UTF-8')); ?>
                <fieldset>
                    <h2><?php echo __('Solicitação De Usuário'); ?></h2>

                    <div class="form-group">
                        <?php echo $this->Form->label('Nome');?>
                        <?php echo $this->Form->input('name', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                        <?php echo $this->Form->label('E-Mail');?>
                        <?php echo $this->Form->input('email', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                        <?php echo $this->Form->label('Usuário de acesso no painel');?>
                            <?php echo $this->Form->input('username', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                        <?php echo $this->Form->label('Senha');?>
                            <?php echo $this->Form->input('password', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                        <?php echo $this->Form->label('Período Letivo');?>
                        <?php echo $this->Form->input('school_period', array('class' => 'form-control','options'=>array('1°'=>'1°','2°'=>'2°','3°'=>'3°','4°'=>'4°','5°'=>'5°','6°'=>'6°','7°'=>'7°','8°'=>'8°'))); ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                        <?php echo $this->Form->label('Objetivo (Meta que você deseja alcançar com o curso)');?>
                            <?php echo $this->Form->input('goal', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                        <?php echo $this->Form->label('Telefone');?>
                            <?php echo $this->Form->input('telephone', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->

                    <?php

                    $this->Html->script(
                        array(  'ajax' ),
                        array(
                            'inline' => false
                        )
                    );
                    ?>

                    <section class="form_endereco" >
                        <div class="form-group cep">
                            <label for="UserCep">Cep</label>
                                <div class="input text"><input  name="data[User][Address][cep]" class="form-control" type="text" id="UserCep">
                                <button  type="button" id='botaoBuscaEndereco' class="btn btn-success">Busca Endereço</button>
                            </div>
                        </div>

                        <div class="form-group rua">
                            <label for="UserCep">Rua</label>
                                <div class="input text">
                                    <input name="data[User][Address][street]" readonly class="form-control" type="text" id="idRua">
                                </div>
                        </div>

                        <div class="form-group bairro">
                            <label for="UserCep">Bairro</label>
                                <div class="input text">
                                    <input readonly name="data[User][Neighborhood][name]" class="form-control" type="text" id="idBairro">
                                </div>
                        </div>

                        <div class="form-group cidade">
                            <label for="UserCep">Cidade</label>
                                <div class="input text"><input name="data[User][City][name]" readonly class="form-control" type="text" id="idCidade">
                            </div>
                        </div>

                        <div class="form-group estado">
                            <label for="UserCep">Estado</label>
                                <input name="data[User][State][name]" readonly  class="form-control"  type="text" id="idEstado">
                                <input name="data[User][State][acronym]" readonly  class="form-control" type="text" id="idEstadoSigla">
                            </div>
                        </div>

                        <div class="form-group numero">
                            <label for="UserCep">Número</label>
                            <div class="input text"><input name="data[User][Address][number]" class="form-control" type="number">
                            </div>
                        </div>

                        <div class="form-group complemento">
                            <label for="UserCep">Complemento</label>
                            <div class="input text"><input name="data[User][Address][complement]" class="form-control" type="text">
                            </div>
                        </div>
                    </section>
                </fieldset>
                <?php echo $this->Form->submit('Enviar Solicitação', array('class' => 'btn btn-large btn-primary enviar_infos botao_infos')); ?>
                <?php echo $this->Html->link('Cancelar Solicitação', array('action'=>'login') ,array('class' => 'btn btn-large btn-danger cancelar_infos botao_infos')); ?>

    <?php echo $this->Form->end(); ?>
			
		</div><!-- /.form -->
			 
	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->
