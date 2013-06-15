<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDRecurso'); ?>
		<?php echo $form->textField($model,'CDRecurso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NMRecurso'); ?>
		<?php echo $form->textField($model,'NMRecurso',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TipoRecurso_CDTipoRecurso'); ?>
		<?php echo $form->textField($model,'TipoRecurso_CDTipoRecurso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TipoHorario_CDHorario'); ?>
		<?php echo $form->textField($model,'TipoHorario_CDHorario'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->