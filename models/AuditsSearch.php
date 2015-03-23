<?php
namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\base\Model;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AuditsSearch extends Audits
{

    public function rules()
    {
        return [
            [['audit_type', 'time', 'doc_title','user_name'],'safe'],
        ];
    }
    
    public function scenarios()
    {
        return Model::scenarios();
    }
    
    public function attributes()
    {
        return array_merge(parent::attributes(),['doc_title', 'user_name']);
    }

    public function search($params){
            $query = Audits::find();
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            $query->joinWith(['user','docs']);
            $dataProvider->setSort([
                'defaultOrder'=>['time'=>SORT_DESC],
                'attributes' => [
                  'doc_title'=>[
                      'asc' => ['docs.title' => SORT_ASC],
                      'desc' => ['docs.title' => SORT_DESC],
                      'label' => 'Doc Title'
                  ],
                  'user_name'=>[
                      'asc' => ['user.username' => SORT_ASC],
                      'desc' => ['user.username' => SORT_DESC],
                      'label' => 'Username'
                  ],
                  'audit_type',
                  'time'
                ]
            ]);
                if (!($this->load($params) && $this->validate())) {
                    return $dataProvider;
                }
                $query->andFilterWhere(['like','docs.title', $this->doc_title]);
                $query->andFilterWhere(['like','user.name', $this->user_name]);
                $query->andFilterWhere(['like','audit_type', $this->audit_type]);
                $query->andFilterWhere(['like','time', $this->time]);
                return $dataProvider;
        }
}