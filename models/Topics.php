<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "topics".
 *
 * @property integer $topic_id
 * @property string $topic
 *
 * @property Docs[] $docs
 */
class Topics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'topics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['topic'], 'required'],
            [['topic'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'topic_id' => 'Topic ID',
            'topic' => 'Topic',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocs()
    {
        return $this->hasMany(Docs::className(), ['topic_id' => 'topic_id']);
    }
}
