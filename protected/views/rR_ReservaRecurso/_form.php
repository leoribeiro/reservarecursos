<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rr--reserva-recurso-form',
	'enableAjaxValidation'=>false,
)); 

function pegaDataHoje(){
	if(date("w")==0){
		$d = mktime(0,0,0,date("m"),date("d")+1,date("Y"));
		return (date("d/m/Y",$d));
	}
	return date("d/m/Y");
}

// function procuradata($somadias){
// 	$d = mktime(0,0,0,date("m"),date("d")+$somadias,date("Y"));
// 	$data = date("Ymd", $d);
// 	return $data;
// }

function somarDia($data, $quantDias){
	$d = mktime(0,0,0,(int)substr($data, 3, 5),((int)substr($data, 0, 2))+$quantDias,(int)substr($data, 6, 9));
	return (date("d/m/Y",$d));
}

?>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo CHtml::label('Período desejado','Periodo'); ?>
		<?php
		    $data=pegaDataHoje();
			$g = 0;
			// enquanto g for menor que 84 dias, 12 semanas.
			$valuesSelect = array();
			$descSelect = array();
			while($g<84){
				$valuesSelect[] = somarDia($data, $g);
				$descSelect[] = somarDia($data, $g)." - ".somarDia($data, $g+7);
				$g = $g+7;
			}
		    $lista = array_combine($valuesSelect, $descSelect);
		
		?>
		<?php echo CHtml::dropDownList('Periodo','',$lista,
		array('maxlength'=>20,'style'=>'width:220px')); ?>
	</div>


	<div class="row">
		<?php echo CHtml::label('Tipo de recurso','TipoRecurso'); ?>
		<?php
		   	$criteria = new CDbCriteria;
			$criteria->order = 'NMTipoRecurso';
			$resultado = RR_TipoRecurso::model()->findAll($criteria);
			$listaTipoRecurso = CHtml::listData($resultado, 'CDTipoRecurso', 'NMTipoRecurso');
		?>
		<?php echo CHtml::dropDownList('TipoRecurso','',$listaTipoRecurso,
		array('maxlength'=>20,'style'=>'width:220px',
		'empty'=>'Selecione um tipo de recurso',
		'ajax' => array(
		'type'=>'POST', //request type
		'url'=>CController::createUrl('RR_ReservaRecurso/JSONAtualizaRecurso'),
		'update'=>'#RR_ReservaRecurso_RRRecurso_CDRecurso',
		))
		); ?>
		<?php echo $form->error($model,'HorarioInicio'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'RRRecurso_CDRecurso'); ?>
		<?php 
		$listaRecurso = array();
		echo CHtml::activeDropDownList($model,'RRRecurso_CDRecurso',$listaRecurso,
		array('style'=>'width:220px',
		'ajax' => array(
		'type'=>'POST', //request type
		'url'=>CController::createUrl('RR_ReservaRecurso/GeraCalendario'),
		'update'=>'#calendario',
		))
		); ?>
		<?php echo $form->error($model,'RRRecurso_CDRecurso'); ?>
	</div>
	
	<div class="row">
	   <div id="calendario"></div>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Reservar' : 'Reservar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->