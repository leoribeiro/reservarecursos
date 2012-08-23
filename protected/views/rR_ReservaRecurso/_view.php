<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDReservaRecurso')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDReservaRecurso), array('view', 'id'=>$data->CDReservaRecurso)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Dia')); ?>:</b>
	<?php echo CHtml::encode($data->Dia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DataReserva')); ?>:</b>
	<?php echo CHtml::encode($data->DataReserva); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HorarioInicio')); ?>:</b>
	<?php echo CHtml::encode($data->HorarioInicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HorarioFim')); ?>:</b>
	<?php echo CHtml::encode($data->HorarioFim); ?>
	<br />


</div>