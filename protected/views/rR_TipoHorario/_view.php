<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDHorario')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDHorario), array('view', 'id'=>$data->CDHorario)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NMHorario')); ?>:</b>
	<?php echo CHtml::encode($data->NMHorario); ?>
	<br />


</div>