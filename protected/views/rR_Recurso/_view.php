<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDRecurso')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDRecurso), array('view', 'id'=>$data->CDRecurso)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NMRecurso')); ?>:</b>
	<?php echo CHtml::encode($data->NMRecurso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TipoRecurso_CDTipoRecurso')); ?>:</b>
	<?php echo CHtml::encode($data->TipoRecurso_CDTipoRecurso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TipoHorario_CDHorario')); ?>:</b>
	<?php echo CHtml::encode($data->TipoHorario_CDHorario); ?>
	<br />


</div>