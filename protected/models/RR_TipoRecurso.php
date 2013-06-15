<?php

/**
 * This is the model class for table "RR_TipoRecurso".
 *
 * The followings are the available columns in table 'RR_TipoRecurso':
 * @property integer $CDTipoRecurso
 * @property string $NMTipoRecurso
 */
class RR_TipoRecurso extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return RR_TipoRecurso the static model class
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
		return 'RR_TipoRecurso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NMTipoRecurso', 'required'),
			array('NMTipoRecurso', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDTipoRecurso, NMTipoRecurso', 'safe', 'on'=>'search'),
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
			'rR_Recursos' => array(self::HAS_MANY, 'RrRecurso', 'TipoRecurso_CDTipoRecurso'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDTipoRecurso' => 'Código',
			'NMTipoRecurso' => 'Tipo de recurso',
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

		$criteria->compare('CDTipoRecurso',$this->CDTipoRecurso);

		$criteria->compare('NMTipoRecurso',$this->NMTipoRecurso,true);

		return new CActiveDataProvider('RR_TipoRecurso', array(
			'criteria'=>$criteria,
		));
	}
}