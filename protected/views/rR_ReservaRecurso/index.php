<?php
$this->breadcrumbs=array(
	'Rr  Reserva Recursos',
);

$this->menu=array(
	array('label'=>'Create RR_ReservaRecurso', 'url'=>array('create')),
	array('label'=>'Manage RR_ReservaRecurso', 'url'=>array('admin')),
);
?>

<h1>Rr  Reserva Recursos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
