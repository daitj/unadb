<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property integer $country_id
 * @property string $country
 * @property string $iso
 *
 * @property Docs[] $docs
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country', 'iso'], 'required'],
            [['country'], 'string', 'max' => 255],
            [['iso'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'country_id' => 'ID',
            'country' => 'Country',
            'iso' => 'ISO',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocs()
    {
        return $this->hasMany(Docs::className(), ['country_id' => 'country_id']);
    }
}
