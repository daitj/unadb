<?php

namespace app\models;

use Yii;
use dektrium\user\models\User;
/**
 * This is the model class for table "audits".
 *
 * @property string $audit_id
 * @property string $doc_id
 * @property string $type
 * @property integer $user_id
 * @property string $time
 *
 * @property Docs $doc
 * @property User $user
 */
class Audits extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'audits';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doc_id', 'audit_type', 'user_id', 'time'], 'required'],
            [['doc_id', 'user_id'], 'integer'],
            [['time'], 'safe'],
            ['audit_type', 'in', 'range' => ['create','update','delete']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'audit_id' => 'Audit ID',
            'doc_id' => 'Document',
            'audit_type' => 'Audit type',
            'user_id' => 'User',
            'time' => 'Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocs()
    {
        return $this->hasOne(Docs::className(), ['doc_id' => 'doc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public static function addLog($doc_id,$audit_type) {
        $audit = new Audits();
        $audit->doc_id=$doc_id;
        $audit->audit_type=$audit_type;
        $audit->user_id = Yii::$app->user->id;
        return $audit->save(false);
    }
}
