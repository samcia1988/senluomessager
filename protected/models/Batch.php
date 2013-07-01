<?php

/**
 * This is the model class for table "sm_batch".
 *
 * The followings are the available columns in table 'sm_batch':
 * @property integer $id
 * @property string $batchname
 * @property string $body
 * @property string $feedback
 */
class Batch extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Batch the static model class
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
		return 'sm_batch';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('batchname, body', 'required'),
			array('batchname, feedback', 'length', 'max'=>128),
			array('body', 'length', 'max'=>160),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, batchname, body, feedback', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'batchname' => '名称',
			'body' => '内容',
			'feedback' => '反馈',
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
		$criteria->compare('batchname',$this->batchname,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('feedback',$this->feedback,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}