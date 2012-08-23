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

<h1>Recursos</h1>


<? $this->renderPartial('/site/botoes',array('modelo'=>'RR_Recurso','descricao'=>'Recurso')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'rr--recurso-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'CDRecurso',
		'NMRecurso',
		'relTipoRecurso.NMTipoRecurso',
		'relTipoHorario.NMHorario',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
