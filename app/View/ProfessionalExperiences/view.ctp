
<div id="page-container" class="row">



	<div id="page-content" class="col-sm-12">
		
		<div class="projects view">

			<h2><?php  echo __('Experiência Profissional Rejeitada'); ?></h2>

            <?php
                $supervisor_description = $professionalExperiences['ProfessionalExperience']['supervisor_description'];
                // verifica a existencia de >revisado< se ela já tiver sido revizado, essa tag vai existir no fim da string
                $description_revisado = stripos ($supervisor_description,">revisado<");
                if ($description_revisado !== false): ?>
                    <p style="color:green;"><?php echo __('Este projeto já foi revisado por você, esperando por nova avaliação do supervisor.'); ?></p>
            <?php endif; ?>


                <table class="table table-bordered">

                        <tr>
                            <td class="col-sm-3">
                                <h4><?php echo __('Descrição'); ?></h4>
                            </td>
                            <td class="success">
                                <p style="font-size:20px">
                                    <?php echo h($professionalExperiences['ProfessionalExperience']['description']); ?>
                                    &nbsp;
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4><?php echo __('Observação do supervisor'); ?></h4>
                            </td>
                            <td style="background-color: #0088cc;">
                                <p style="font-size:20px ">


                                        <?php echo h(utf8_encode(str_replace(">revisado<","",$professionalExperiences['ProfessionalExperience']['supervisor_description']))); ?>


                                </p>
                            </td>
                        </tr>



                </table>




                    <?php echo $this->Html->link(__('Reenviar Experiência Profissional'), array('action' => 'edit', $professionalExperiences['ProfessionalExperience']['id']), array('class' => 'btn btn-large btn-primary')); ?>


			
		</div><!-- /.view -->

			
	</div><!-- /#page-content .span9 -->

</div><!-- /#page-container .row-fluid -->
