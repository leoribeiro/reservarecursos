<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('rr--reserva-recurso-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

	<div class="tituloReq">
	<?php
	   if(Yii::app()->user->name == 'admin'){
		  echo "Recursos reservados";
	  }
	  else{
		  echo "Meus recursos reservados";
	  }
	?>
	</div>

<div id="statusMsg"></div>

<?php
if(!is_null($saveSuccess)){
	echo "<div class='flash-success-req'>";
	echo "<div style='width: 4%; float: left;height:40px;display:table-cell;padding:5px;vertical-align:middle;'>";
	echo CHtml::image($this->createUrl('images/accept.png'),'');
	echo "</div>";
	echo "<div style='width: 96%; height:40px;display:table-cell;padding:5px;vertical-align:middle;'>";
	echo "Reserva feita com sucesso.";
	echo '</div></div>';
}

 
	$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'rr-reserva-recurso-grid',
	'dataProvider'=>$model->search('Atual'),
	'filter'=>$model,
	'columns'=>array(
		'CDReservaRecurso',
		array(
			'name'=>'recursoNMRecurso',
			'value'=>'$data->relRecurso->NMRecurso',
			'type'=>'text',
			'header'=>'Recurso',
		),
		array(
			'name'=>'Dia',
			'value'=>'$data->Dia',
			'type'=>'text',
			'header'=>'Data escolhida',
		),
		array(
			'name'=>'DataReserva',
			'value'=>'date("d/m/Y H:i:s",strtotime($data->DataReserva))',
			'type'=>'text',
			'header'=>'Data da reserva',
		),
		array(
			'name'=>'horarioNMHorario',
			'value'=>'$data->relHorario->NMHorario',
			'type'=>'text',
			'header'=>'Horário',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>' {delete}',
			'buttons' => array(
			'delete' => array(
			            'label'=>'Excluir reserva',
			)),
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,50=>50,100=>100),
		      array(
		           'onchange'=>"$.fn.yiiGridView.update('rr-reserva-recurso-grid',{ data:{pageSize: $(this).val() }})",
				   'style'=>' font-size: 12px; padding: 0px;margin-bottom: 0px;',
		      )),
		),
	),
)); ?>
