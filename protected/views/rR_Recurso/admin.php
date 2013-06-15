<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('rr--recurso-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div id="titlePages">Recursos</div>


<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Novo Recurso',
    'type'=>'primary',
    'size'=>'',
    'url'=>$this->createUrl('RR_Recurso/create')
));

?>

<div id="statusMsg"></div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
'type'=>'striped bordered condensed',
	'id'=>'rr--recurso-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'CDRecurso',
		'NMRecurso',
		'relTipoRecurso.NMTipoRecurso',
		'relTipoHorario.NMHorario',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
		),
	),
)); ?>
