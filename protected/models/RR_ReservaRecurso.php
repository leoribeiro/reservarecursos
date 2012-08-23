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
			array('Dia, DataReserva, HorarioInicio, HorarioFim', 'required'),
			array('Horario,RRRecurso_CDRecurso, Servidor_CDServidor', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDReservaRecurso, Dia, DataReserva, Horario,RRRecurso_CDRecurso', 'safe', 'on'=>'search'),
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
			'relHorario' => array(self::BELONGS_TO, 'RR_Horario', 'HorarioInicio'),
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

		$criteria=new CDbCriteria;

		$criteria->compare('CDReservaRecurso',$this->CDReservaRecurso);

		$criteria->compare('Dia',$this->Dia,true);

		$criteria->compare('DataReserva',$this->DataReserva,true);

		$criteria->compare('Horario',$this->Horario);


		return new CActiveDataProvider('RR_ReservaRecurso', array(
			'criteria'=>$criteria,
		));
	}
}