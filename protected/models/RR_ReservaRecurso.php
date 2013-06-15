<?php

/**
 * This is the model class for table "RR_ReservaRecurso".
 *
 * The followings are the available columns in table 'RR_ReservaRecurso':
 * @property integer $CDReservaRecurso
 * @property string $Dia
 * @property string $DataReserva
 * @property integer $HorarioInicio
 * @property integer $HorarioFim
 */
class RR_ReservaRecurso extends CActiveRecord
{
	
	
	public $recursoNMRecurso;
	public $horarioNMHorario;
	public $servidorNMServidor;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return RR_ReservaRecurso the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'RR_ReservaRecurso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Dia, Horario, RRRecurso_CDRecurso', 'required'),
			array('Horario,RRRecurso_CDRecurso, Servidor_CDServidor', 'numerical', 'integerOnly'=>true),
			array('Dia','type','type'=>'date','dateFormat'=>Yii::app()->locale->dateFormat),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDReservaRecurso, Dia, DataReserva,
			Horario,RRRecurso_CDRecurso,recursoNMRecurso,
			horarioNMHorario,servidorNMServidor', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'relHorario' => array(self::BELONGS_TO, 'RR_Horario', 'Horario'),
			'relRecurso' => array(self::BELONGS_TO, 'RR_Recurso', 'RRRecurso_CDRecurso'),
			'relServidor' => array(self::BELONGS_TO, 'Servidor', 'Servidor_CDServidor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDReservaRecurso' => 'Código',
			'Dia' => 'Dia',
			'DataReserva' => 'Data da reserva',
			'Horario' => 'Horário',
			'RRRecurso_CDRecurso' => 'Recurso',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$parametros = func_get_args(); 

		$criteria=new CDbCriteria;
		
		$criteria->with = array('relHorario','relRecurso','relServidor');
		
		$criteria->together = true;

		$criteria->compare('CDReservaRecurso',$this->CDReservaRecurso);
		
		if($this->Dia != ''){
			$Data = $this->Dia;
			$ar = explode('/', $Data);
			if(count($ar) == 3)
				$this->Dia = $ar[2].'-'.$ar[1].'-'.$ar[0];
	    }

		$criteria->compare('Dia',$this->Dia,true);
		
		if($this->Dia != ''){
			$Data= $this->Dia;
			$ar = explode('-', $Data);
			if(count($ar) == 3)
				$this->Dia = $ar[2].'/'.$ar[1].'/'.$ar[0];
	    }

		$criteria->compare('DataReserva',$this->DataReserva,true);

		$criteria->compare('relHorario.NMHorario',$this->horarioNMHorario,true);
		
		$criteria->compare('relRecurso.NMRecurso',$this->recursoNMRecurso,true);
		
		$criteria->compare('relServidor.NMServidor',$this->servidorNMServidor,true);
		
		if(Yii::app()->user->name != 'admin'){
			if(!is_null(Yii::app()->user->getModelServidor())){
				$CDServidor = Yii::app()->user->getModelServidor()->CDServidor;
				$criteria->compare('Servidor_CDServidor',$CDServidor);
			}			
		}
		
		
		foreach ($parametros as $parametro)
		{
			if($parametro == 'Historico')
				$criteria->compare('Dia','<'.date('Y-m-d'));
			else if($parametro == 'Atual'){
				$criteria->compare('Dia','>='.date('Y-m-d'));
			}
		}
		
		$criteria->order = 'Dia,CDReservaRecurso';


		return new CActiveDataProvider('RR_ReservaRecurso', array(
			'pagination'=>array(
			      'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() {
		
		if(Yii::app()->user->name == 'admin'){
			$this->Servidor_CDServidor = null;
		}
		else{
			$this->Servidor_CDServidor = Yii::app()->user->CDServidor;
		}
		
		if(!isset(Yii::app()->session['dadosReservas'])){
			$this->addError('RRRecurso_CDRecurso','Selecione algum horário disponível.');
			return false;
		}
		
		
		return parent::beforeSave();
	}
	
	public function behaviors()
	{
	    return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior'),	
	); 

	}
}