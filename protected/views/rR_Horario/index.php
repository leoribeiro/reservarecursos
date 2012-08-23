<?php
$this->breadcrumbs=array(
	'Rr  Horarios',
);

$this->menu=array(
	array('label'=>'Create RR_Horario', 'url'=>array('create')),
	array('label'=>'Manage RR_Horario', 'url'=>array('admin')),
);
?>

<h1>Rr  Horarios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
