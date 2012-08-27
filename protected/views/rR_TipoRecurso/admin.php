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

<h1>Tipos de recursos</h1>

<div id="statusMsg"></div>

<? $this->renderPartial('/site/botoes',array('modelo'=>'RR_TipoRecurso','descricao'=>'Tipo de recurso')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'rr--tipo-recurso-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'CDTipoRecurso',
		'NMTipoRecurso',
		array(
			'class'=>'CButtonColumn',
			'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
		),
	),
)); ?>
