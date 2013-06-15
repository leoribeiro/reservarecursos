<?php

/**
 * This is the model class for table "RR_Recurso".
 *
 * The followings are the available columns in table 'RR_Recurso':
 * @property integer $CDRecurso
 * @property string $NMRecurso
 * @property integer $TipoRecurso_CDTipoRecurso
 * @property integer $TipoHorario_CDHorario
 */
class RR_Recurso extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return RR_Recurso the static model class
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
		return 'RR_Recurso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NMRecurso, TipoRecurso_CDTipoRecurso, TipoHorario_CDHorario,LimiteReserva', 'required'),
			array('TipoRecurso_CDTipoRecurso, TipoHorario_CDHorario,LimiteReserva', 'numerical', 'integerOnly'=>true),
			array('NMRecurso', 'length', 'max'=>45),
			array('LimiteReserva', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDRecurso, NMRecurso, TipoRecurso_CDTipoRecurso, TipoHorario_CDHorario', 'safe', 'on'=>'search'),
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
			'relTipoRecurso' => array(self::BELONGS_TO, 'RR_TipoRecurso', 'TipoRecurso_CDTipoRecurso'),
			'relTipoHorario' => array(self::BELONGS_TO, 'RR_TipoHorario', 'TipoHorario_CDHorario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDRecurso' => 'Código',
			'NMRecurso' => 'Nome do recurso',
			'TipoRecurso_CDTipoRecurso' => 'Tipo de recurso',
			'TipoHorario_CDHorario' => 'Tipo de horário',
			'LimiteReserva' => 'Limite máximo de reservas',
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

		$criteria->compare('CDRecurso',$this->CDRecurso);

		$criteria->compare('NMRecurso',$this->NMRecurso,true);

		$criteria->compare('TipoRecurso_CDTipoRecurso',$this->TipoRecurso_CDTipoRecurso);

		$criteria->compare('TipoHorario_CDHorario',$this->TipoHorario_CDHorario);

		return new CActiveDataProvider('RR_Recurso', array(
			'criteria'=>$criteria,
		));
	}
}