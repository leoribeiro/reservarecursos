<?php

/**
 * This is the model class for table "RR_Horario".
 *
 * The followings are the available columns in table 'RR_Horario':
 * @property integer $CDHorario
 * @property string $NMHorario
 */
class RR_Horario extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return RR_Horario the static model class
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
		return 'RR_Horario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NMHorario', 'required'),
			array('NMHorario', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDHorario, NMHorario', 'safe', 'on'=>'search'),
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
			'rR_ReservaRecursos' => array(self::HAS_MANY, 'RR_ReservaRecurso', 'HorarioFim'),
			'relTipoHorario' => array(self::MANY_MANY, 'RR_TipoHorario', 'RR_TipoHorarioHasHorario(TipoHorario_CDHorario, Horario_CDHorario)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDHorario' => 'Código',
			'NMHorario' => 'Horário',
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

		$criteria->compare('CDHorario',$this->CDHorario);

		$criteria->compare('NMHorario',$this->NMHorario,true);

		return new CActiveDataProvider('RR_Horario', array(
			'criteria'=>$criteria,
		));
	}
}