
<h1>Recurso <?php echo $model->CDRecurso; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDRecurso',
		'NMRecurso',
		'relTipoRecurso.NMTipoRecurso',
		'relTipoHorario.NMHorario',
	),
)); ?>
