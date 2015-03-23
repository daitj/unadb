<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sessions".
 *
 * @property integer $session_id
 * @property string $session_name
 * @property string $session_description
 *
 * @property Docs[] $docs
 */
class Sessions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sessions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['session_name', 'session_description'], 'required'],
            [['session_description'], 'string'],
            [['session_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'session_id' => 'Session ID',
            'session_name' => 'Session Name',
            'session_description' => 'Session Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocs()
    {
        return $this->hasMany(Docs::className(), ['session_id' => 'session_id']);
    }
}
