<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDTipoRecurso'); ?>
		<?php echo $form->textField($model,'CDTipoRecurso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NMTipoRecurso'); ?>
		<?php echo $form->textField($model,'NMTipoRecurso',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->