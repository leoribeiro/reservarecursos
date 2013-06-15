<?php
$this->breadcrumbs=array(
	'Rr  Recursos',
);

$this->menu=array(
	array('label'=>'Create RR_Recurso', 'url'=>array('create')),
	array('label'=>'Manage RR_Recurso', 'url'=>array('admin')),
);
?>

<h1>Rr  Recursos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
