<?php

/**
 * This is the model class for table "sm_map".
 *
 * The followings are the available columns in table 'sm_map':
 * @property integer $id
 * @property string $name
 * @property double $lng
 * @property double $lat
 * @property string $tel
 * @property integer $state
 */
class Map extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Map the static model class
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
		return 'sm_map';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, lng, lat, tel', 'required'),
			array('lng, lat', 'numerical'),
			array('name', 'length', 'max'=>128),
			array('tel', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, lng, lat, tel', 'safe', 'on'=>'search'),
			array('state','default','value'=>'0'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '终端序号',
			'name' => '终端名称',
			'lng' => '横坐标',
			'lat' => '纵坐标',
			'tel' => '终端号码',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('lng',$this->lng);
		$criteria->compare('lat',$this->lat);
		$criteria->compare('tel',$this->tel,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
