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

//Remove variável de sessão responsável pelo controle da reserva dos recursos
unset(Yii::app()->session['ids_Reserva']);
unset(Yii::app()->session['dadosReservas']);

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
		array('maxlength'=>20,'style'=>'width:220px',
			'ajax' => array(
			'type'=>'POST', //request type
			'url'=>CController::createUrl('RR_ReservaRecurso/GeraCalendario'),
			'update'=>'#calendario',
			'beforeSend' => 'function(){
		      $("#divload").addClass("loading");}',
		     'complete' => 'function(){
		      $("#divload").removeClass("loading");}',
			))); ?>
	</div>


	<div class="row">
		<?php echo CHtml::label('Tipo de recurso','TipoRecurso'); ?>
		<?php
		   	$rec = 0;
			if(!empty($model->RRRecurso_CDRecurso)){
				$criteria = new CDbCriteria;
				$criteria->order = 'NMTipoRecurso';
				$criteriaRR = new CDbCriteria;
				$criteriaRR->compare('CDRecurso',$model->RRRecurso_CDRecurso);
				$resultadoRR = RR_Recurso::model()->find($criteriaRR);
				$criteria->compare('CDTipoRecurso',$resultadoRR->TipoRecurso_CDTipoRecurso);
				$resultado = RR_TipoRecurso::model()->find($criteria);
				$rec = $resultado->CDTipoRecurso;
			}
			else{
				$criteria = new CDbCriteria;
				$criteria->order = 'NMTipoRecurso';
				$resultado = RR_TipoRecurso::model()->find($criteria);
				$rec = $resultado->CDTipoRecurso;
			}
			
			$criteria = new CDbCriteria;
			$criteria->order = 'NMTipoRecurso';
			$resultado = RR_TipoRecurso::model()->findAll($criteria);	
			
			$listaTipoRecurso = CHtml::listData($resultado, 'CDTipoRecurso', 'NMTipoRecurso');
		?>
		<?php echo CHtml::dropDownList('TipoRecurso','',$listaTipoRecurso,
		array('maxlength'=>20,'style'=>'width:220px',
		'empty'=>'Selecione',
		'options' => array($rec=>array('selected'=>true)),
		'ajax' => array(
		'type'=>'POST', //request type
		'url'=>CController::createUrl('RR_ReservaRecurso/JSONAtualizaRecurso'),
		'update'=>'#RR_ReservaRecurso_RRRecurso_CDRecurso',
		'beforeSend' => 'function(){
	      $("#divload").addClass("loading");}',
	     'complete' => 'function(){
	      $("#divload").removeClass("loading");}',
		))
		); ?>
		<?php echo $form->error($model,'HorarioInicio'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'RRRecurso_CDRecurso'); ?>
		<?php 
		if(!empty($model->RRRecurso_CDRecurso)){
			$criteriaRR = new CDbCriteria;
			$criteriaRR->compare('TipoRecurso_CDTipoRecurso',$rec);
			$resultadoRR = RR_Recurso::model()->findAll($criteriaRR);
			$listaRecurso = CHtml::listData($resultadoRR, 'CDRecurso', 'NMRecurso');
		}
		else{
			$criteriaRR = new CDbCriteria;
			$criteriaRR->compare('TipoRecurso_CDTipoRecurso',$rec);
			$resultadoRR = RR_Recurso::model()->findAll($criteriaRR);
			$listaRecurso = CHtml::listData($resultadoRR, 'CDRecurso', 'NMRecurso');	
		}
		
		
		echo CHtml::activeDropDownList($model,'RRRecurso_CDRecurso',$listaRecurso,
		array('style'=>'width:220px',
		'ajax' => array(
		'type'=>'POST', //request type
		'url'=>CController::createUrl('RR_ReservaRecurso/GeraCalendario'),
		'update'=>'#calendario',
		'beforeSend' => 'function(){
	      $("#divload").addClass("loading");}',
	     'complete' => 'function(){
	      $("#divload").removeClass("loading");}',
		))
		); 
		
		?>
		<?php echo $form->error($model,'RRRecurso_CDRecurso'); ?>
		
	</div>
	
	<div class="row">
	   <div id="divload" style="height: 16px; width: 16px;"></div>
	   <div id="calendario" align="center"><i>Nenhum recurso selecionado.</i></div>
	</div>

	<div align="center">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>$model->isNewRecord ? 'Reservar recurso' : 'Reservar recurso',
	)); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->



		<?php //Yii::app()->clientScript->registerScript('teste',
		    //"$('#RR_ReservaRecurso_RRRecurso_CDRecurso').change();"
		    //,CClientScript::POS_READY); 
		?>

