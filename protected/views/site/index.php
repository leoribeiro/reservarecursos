<?php $this->pageTitle=Yii::app()->name; 


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

	<div id="titlePages">
	<?php
	   if(Yii::app()->user->name == 'admin'){
		  echo "Recursos reservados";
	  }
	  else{
		  echo "Meus recursos reservados";
	  }
	?>
	</div>
<?php
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('bootstrap.widgets.TbGridView', array(
'type'=>'striped bordered condensed',
'id'=>'rr-reserva-recurso-grid',
'enableSorting' => false,
'dataProvider'=>$model->search('Atual'),
'filter'=>$model,
'afterAjaxUpdate' => 'reinstallDatePicker',
'columns'=>array(
	array(
		'name'=>'servidorNMServidor',
		'value'=>'!is_null($data->relServidor) ? ($data->relServidor->NMServidor) : "Administrador"',
		'type'=>'text',
		'header'=>'Servidor',
		'visible'=>'(Yii::app()->user->name == "admin")',
	),
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
		'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model'=>$model,
            'attribute'=>'Dia',
            'language'=>'pt-BR',
			'i18nScriptFile' => 'jquery.ui.datepicker-ja.js', // (#2)
            'htmlOptions' => array(
              'id' => 'datepicker_for_due_date',
              'size' => '10',
            ),
			'defaultOptions' => array(  // (#3)
                'showOn' => 'focus', 
                'dateFormat' => 'dd/mm/yy',
                'showOtherMonths' => true,
                'selectOtherMonths' => true,
                'changeMonth' => true,
                'changeYear' => true,
                'showButtonPanel' => true,
            )
       ), true),
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
					'url'=> 'Yii::app()->createUrl("RR_ReservaRecurso/delete", array("id" => $data->CDReservaRecurso))',
		)),
		// 'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,50=>50,100=>100),
	 //      array(
	 //           'onchange'=>"$.fn.yiiGridView.update('rr-reserva-recurso-grid',{ data:{pageSize: $(this).val() }})",
		// 	   'style'=>' font-size: 12px; padding: 0px;margin-bottom: 0px;',
	 //      )),
	),
),
)); 

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#datepicker_for_due_date').datepicker();
}
");

?>

