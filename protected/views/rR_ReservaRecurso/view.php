<?php
$this->breadcrumbs=array(
	'Rr  Reserva Recursos'=>array('index'),
	$model->CDReservaRecurso,
);

$this->menu=array(
	array('label'=>'List RR_ReservaRecurso', 'url'=>array('index')),
	array('label'=>'Create RR_ReservaRecurso', 'url'=>array('create')),
	array('label'=>'Update RR_ReservaRecurso', 'url'=>array('update', 'id'=>$model->CDReservaRecurso)),
	array('label'=>'Delete RR_ReservaRecurso', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDReservaRecurso),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RR_ReservaRecurso', 'url'=>array('admin')),
);
?>

<h1>View RR_ReservaRecurso #<?php echo $model->CDReservaRecurso; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDReservaRecurso',
		'Dia',
		'DataReserva',
		'HorarioInicio',
		'HorarioFim',
	),
)); ?>
