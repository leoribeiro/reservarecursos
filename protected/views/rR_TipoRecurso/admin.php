<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('rr--tipo-recurso-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div id="titlePages">Tipos de recursos</div>

<div id="statusMsg"></div>

<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Novo tipo de recurso',
    'type'=>'primary',
    'size'=>'',
    'url'=>$this->createUrl('RR_TipoRecurso/create')
));

?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
'type'=>'striped bordered condensed',
	'id'=>'rr--tipo-recurso-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'CDTipoRecurso',
		'NMTipoRecurso',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
		),
	),
)); ?>
