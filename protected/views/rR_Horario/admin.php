<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('rr--horario-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div id="titlePages">Horários</div>

<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Novo Horário',
    'type'=>'primary',
    'size'=>'',
    'url'=>$this->createUrl('RR_Horario/create')
));

?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
'type'=>'striped bordered condensed',
	'id'=>'rr--horario-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'CDHorario',
		'NMHorario',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
