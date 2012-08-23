<?php
$this->breadcrumbs=array(
	'Rr  Tipo Horarios',
);

$this->menu=array(
	array('label'=>'Create RR_TipoHorario', 'url'=>array('create')),
	array('label'=>'Manage RR_TipoHorario', 'url'=>array('admin')),
);
?>

<h1>Rr  Tipo Horarios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
