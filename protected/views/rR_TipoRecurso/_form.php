<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rr--tipo-recurso-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NMTipoRecurso'); ?>
		<?php echo $form->textField($model,'NMTipoRecurso',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'NMTipoRecurso'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Salvar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->