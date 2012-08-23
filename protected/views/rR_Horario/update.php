<?php
$this->breadcrumbs=array(
	'Rr  Horarios'=>array('index'),
	$model->CDHorario=>array('view','id'=>$model->CDHorario),
	'Update',
);

$this->menu=array(
	array('label'=>'List RR_Horario', 'url'=>array('index')),
	array('label'=>'Create RR_Horario', 'url'=>array('create')),
	array('label'=>'View RR_Horario', 'url'=>array('view', 'id'=>$model->CDHorario)),
	array('label'=>'Manage RR_Horario', 'url'=>array('admin')),
);
?>

<h1>Update RR_Horario <?php echo $model->CDHorario; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>