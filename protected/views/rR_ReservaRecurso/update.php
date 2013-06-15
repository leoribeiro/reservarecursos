<?php
$this->breadcrumbs=array(
	'Rr  Reserva Recursos'=>array('index'),
	$model->CDReservaRecurso=>array('view','id'=>$model->CDReservaRecurso),
	'Update',
);

$this->menu=array(
	array('label'=>'List RR_ReservaRecurso', 'url'=>array('index')),
	array('label'=>'Create RR_ReservaRecurso', 'url'=>array('create')),
	array('label'=>'View RR_ReservaRecurso', 'url'=>array('view', 'id'=>$model->CDReservaRecurso)),
	array('label'=>'Manage RR_ReservaRecurso', 'url'=>array('admin')),
);
?>

<h1>Update RR_ReservaRecurso <?php echo $model->CDReservaRecurso; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>