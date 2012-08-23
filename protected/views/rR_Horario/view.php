<?php
$this->breadcrumbs=array(
	'Rr  Horarios'=>array('index'),
	$model->CDHorario,
);

$this->menu=array(
	array('label'=>'List RR_Horario', 'url'=>array('index')),
	array('label'=>'Create RR_Horario', 'url'=>array('create')),
	array('label'=>'Update RR_Horario', 'url'=>array('update', 'id'=>$model->CDHorario)),
	array('label'=>'Delete RR_Horario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDHorario),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RR_Horario', 'url'=>array('admin')),
);
?>

<h1>View RR_Horario #<?php echo $model->CDHorario; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDHorario',
		'NMHorario',
	),
)); ?>
