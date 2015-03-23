<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "docs".
 *
 * @property string $doc_id
 * @property string $title
 * @property integer $topic_id
 * @property string $file
 * @property integer $country_id
 * @property integer $session_id
 * @property string $date_council
 *
 * @property Audits[] $audits
 * @property Sessions $session
 * @property Countries $country
 * @property Topics $topic
 */
class Docs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'docs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'topic_id', 'country_id', 'session_id','date_council'], 'required'],
            ['file','required', 'on'=>'create'],
            [['topic_id', 'country_id', 'session_id'], 'integer'],
            [['file'], 'file', 'extensions' => 'doc, docx, pdf'],
            [['title'], 'string', 'max' => 255]
        ];
    }
    
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['update'] = ['title', 'topic_id', 'country_id', 'session_id','date_council'];
        return $scenarios;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'doc_id' => 'Doc ID',
            'title' => 'Title',
            'topic_id' => 'Topic',
            'file' => 'File',
            'country_id' => 'Country',
            'session_id' => 'Session',
            'date_council' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudits()
    {
        return $this->hasMany(Audits::className(), ['doc_id' => 'doc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSessions()
    {
        return $this->hasOne(Sessions::className(), ['session_id' => 'session_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountries()
    {
        return $this->hasOne(Countries::className(), ['country_id' => 'country_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopics()
    {
        return $this->hasOne(Topics::className(), ['topic_id' => 'topic_id']);
    }
}
