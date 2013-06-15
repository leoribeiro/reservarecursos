<h1>Tipo de recurso <?php echo $model->CDTipoRecurso; ?></h1>

<?php

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDTipoRecurso',
		'NMTipoRecurso',
	),
)); ?>
