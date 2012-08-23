<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rr--tipo-horario-form',
	'enableAjaxValidation'=>false,
)); 

//Remove variável de sessão responsável pelo controle dos horários
unset(Yii::app()->session['HorariosEscolhidos_NMHorario']);

if(!empty($model->CDHorario)){
	$criteria = new CDbCriteria;
	$criteria->with =
	array('relTipoHorario');
	$criteria->together = true;
	$criteria->compare('relTipoHorario.CDHorario',
	$model->CDHorario);

	$resultado = RR_Horario::model()->findAll($criteria);

	//Trata os horário em um update
	$HorariosEscolhidos = array();
	foreach($resultado as $registro){
		$HorariosEscolhidos[] = $registro->NMHorario;	
	}
	Yii::app()->session['HorariosEscolhidos_NMHorario'] = $HorariosEscolhidos;
}



?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NMHorario'); ?>
		<?php echo $form->textField($model,'NMHorario',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'NMHorario'); ?>
	</div>
	
	<div class="row">
		<?php echo CHtml::label('Adicionar Horário','HorarioAdiciona'); ?>
		<div id="horarios_selecionados">
		<?php
		if(!empty($HorariosEscolhidos)){
			for($x=0;$x<count($HorariosEscolhidos);$x++){
				echo CHtml::textField('HorarioAdiciona'.$x,$HorariosEscolhidos[$x],array('size'=>20,'maxlength'=>20));
				echo "<br />";
			}

	        
	    }
		?>
		<?php echo CHtml::textField('HorarioAdiciona','',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo CHtml::ajaxLink(CHtml::image($this->createUrl('images/add.png'),'Adicionar horário'), 
		$this->createUrl('RR_TipoHorario/AdicionaHorario'),
		array(
			'type' =>'POST',
		    'update'=>'#horarios_selecionados', //selector to update
		)); ?>
		</div>
	</div>
	
	
	<br />
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Salvar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
