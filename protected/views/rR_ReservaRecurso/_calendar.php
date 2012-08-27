<?php

function passPort($data){
	$dias_semana = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sabádo');
	$d = mktime(0,0,0,(int)substr($data, 3, 5),(int)substr($data, 0, 2),(int)substr($data, 6, 9));
	return $dias_semana[date("w", $d)];
}

function somarDia($data, $quantDias){
	$d = mktime(0,0,0,(int)substr($data, 3, 5),((int)substr($data, 0, 2))+$quantDias,(int)substr($data, 6, 9));
	return (date("d/m/Y",$d));
}

function verificaDisponibilidade($dia, $horario, $recurso){
	$criteria = new CDbCriteria;
	$criteria->with = array('relServidor');
	$criteria->together;
	$ar = explode('/', $dia);
	$dia = $ar[2].'-'.$ar[1].'-'.$ar[0];
	$criteria->compare('Dia',$dia);
	$criteria->compare('Horario',$horario);
	$criteria->compare('RRRecurso_CDRecurso',$recurso);
	$resultado = RR_ReservaRecurso::model()->find($criteria);
	if(is_null($resultado)){
		return null;
	}
	else{
		$servidor = $resultado->relServidor;
		if(is_null($servidor)){
			return 'Administrador';
		}
		return $resultado->relServidor->NMServidor;
	}
	
	
}

 $tabela  = "<table id=\"calendar\">";
 $tabela .= "<tr>";
 $tabela .= "<td colspan=9 class=\"month\">";
 $tabela .= "Recurso: ".$resultadoRecurso->NMRecurso;			
 $tabela .= "</td></tr>";
 
 // dias da semana
 $tabela.= "<tr class=\"daynames\">"; 		
 $tabela.= "<td>Horário</td>";
 $dias = array();
 for($x=0;$x<8;$x++){
	$tabela .= "<td>";
	$tabela .= passPort(somarDia($Periodo,$x));
	$tabela .= "<br />";
	$tabela .= somarDia($Periodo,$x);
	$tabela .= "</td>";
	$dias[] = somarDia($Periodo,$x);
}
$tabela .= "</tr>";

 $id = 0;
 foreach($Horarios as $horario){
	$tabela .= "<tr class=\"weekres\">";
	$tabela .= "<td>".$horario->NMHorario."</td>";
	for($x=0;$x<8;$x++){
		$tabela .= "<td>";
		$tabela .= "<div id=".$id.">";
		$hor = substr($horario->NMHorario,0,2);
		if($dias[$x]==date('d/m/Y') and is_numeric($hor) and $hor<=date('H')){
			$tabela .= "Fechado";
		}else if(!is_null(verificaDisponibilidade($dias[$x],$horario->CDHorario,$resultadoRecurso->CDRecurso))){
			    $NMServidor = verificaDisponibilidade($dias[$x],$horario->CDHorario,$resultadoRecurso->CDRecurso);
				$tabela .= CHtml::link('Reservado','',
				array('id' => 'send-link-'.uniqid(),
				       'style'=>'color: #FF0000;',
				       'title'=>('Reservado por '.$NMServidor)));
		}
		else if(in_array($id,$idsReservados)){
			$tabela .= CHtml::ajaxLink('Reservar',
			array('RR_ReservaRecurso/GeraCalendario',
			'idReservar'=>$id, 'Periodo'=>$Periodo, 'idRecurso'=>$idRecurso, 'opRecurso'=>1),
			array('update' => '#calendario',
			     'beforeSend' => 'function(){
				      $("#divload").addClass("loading");}',
				    'complete' => 'function(){
				      $("#divload").removeClass("loading");}',),
			array('id' => 'send-link-'.uniqid(),
			       'style'=>'color: #00CC00;'));
		}
		else{
			$tabela .= CHtml::ajaxLink('Disponível',
			array('RR_ReservaRecurso/GeraCalendario',
			'idReservar'=>$id, 'Periodo'=>$Periodo, 'idRecurso'=>$idRecurso, 'opRecurso'=>0,
			'dia'=>$dias[$x],'horario'=>$horario->CDHorario),
			array('update' => '#calendario',
			      'beforeSend' => 'function(){
			      $("#divload").addClass("loading");}',
			     'complete' => 'function(){
			      $("#divload").removeClass("loading");}',),
			array('id' => 'send-link-'.uniqid()));
		}
		 

		$tabela .= "</div>";
		$tabela .= "</td>";
		$id++;
	}
	$tabela .= "</tr>";
 }

$tabela .= "</table>";


if(is_null($idRecurso)){
	echo "<div align=center>";
	echo "<i> Nenhum recurso disponível </i>";
	echo "</div>";
}
else{
	echo $tabela;
}


?>