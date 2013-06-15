<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDTipoRecurso')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDTipoRecurso), array('view', 'id'=>$data->CDTipoRecurso)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NMTipoRecurso')); ?>:</b>
	<?php echo CHtml::encode($data->NMTipoRecurso); ?>
	<br />


</div>