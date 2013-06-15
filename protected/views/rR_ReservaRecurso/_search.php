<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDReservaRecurso'); ?>
		<?php echo $form->textField($model,'CDReservaRecurso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Dia'); ?>
		<?php echo $form->textField($model,'Dia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DataReserva'); ?>
		<?php echo $form->textField($model,'DataReserva'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Horario'); ?>
		<?php echo $form->textField($model,'Horario'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->