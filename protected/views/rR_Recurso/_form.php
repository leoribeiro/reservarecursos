<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rr--recurso-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NMRecurso'); ?>
		<?php echo $form->textField($model,'NMRecurso',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'NMRecurso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TipoRecurso_CDTipoRecurso'); ?>
		<?php $lista =CHtml::listData(RR_TipoRecurso::model()->findAll(array('order'=>'NMTipoRecurso')), 'CDTipoRecurso', 'NMTipoRecurso'); ?>
		<?php echo CHtml::activeDropDownList($model,'TipoRecurso_CDTipoRecurso',$lista,array('empty'=>'','style'=>'width:220px')); ?>
		<?php echo $form->error($model,'TipoRecurso_CDTipoRecurso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TipoHorario_CDHorario'); ?>
		<?php $lista =CHtml::listData(RR_TipoHorario::model()->findAll(array('order'=>'NMHorario')), 'CDHorario', 'NMHorario'); ?>
		<?php echo CHtml::activeDropDownList($model,'TipoHorario_CDHorario',$lista,array('empty'=>'','style'=>'width:220px')); ?>
		<?php echo $form->error($model,'TipoHorario_CDHorario'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'LimiteReserva'); ?>
		<?php echo $form->textField($model,'LimiteReserva',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'LimiteReserva'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Salvar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->