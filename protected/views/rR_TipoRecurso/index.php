<?php
$this->breadcrumbs=array(
	'Rr  Tipo Recursos',
);

$this->menu=array(
	array('label'=>'Create RR_TipoRecurso', 'url'=>array('create')),
	array('label'=>'Manage RR_TipoRecurso', 'url'=>array('admin')),
);
?>

<h1>Rr  Tipo Recursos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
