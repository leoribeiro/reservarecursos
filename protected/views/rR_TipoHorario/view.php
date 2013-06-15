

<h1>Tipo de horário <?php echo $model->CDHorario; ?></h1>

<?php 

$criteria = new CDBCriteria;
$criteria->with =
array('relTipoHorario');
$criteria->together = true;
$criteria->compare('relTipoHorario.CDHorario',
$model->CDHorario);

$resultado = RR_Horario::model()->findAll($criteria);

//Trata os horário em um update
$HorariosEscolhidos = "";
foreach($resultado as $registro){
	$HorariosEscolhidos .= $registro->NMHorario.", ";	
}

$HorariosEscolhidos = substr($HorariosEscolhidos, 0, -2);

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDHorario',
		'NMHorario',
		array(
			'label'=>'Horários',
			'value'=>$HorariosEscolhidos,
			'filter'=>false,
		),
	),
)); ?>
