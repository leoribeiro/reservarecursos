<?php
$this->breadcrumbs=array(
	'Rr  Horarios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RR_Horario', 'url'=>array('index')),
	array('label'=>'Manage RR_Horario', 'url'=>array('admin')),
);
?>

<h1>Novo horário</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>