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

class DocsSearch extends Docs
{

    
    
    public function rules()
    {
        return [
            [['session_name','country_name', 'topic_name','title','date_council'],'safe'],
        ];
    }
    
    public function scenarios()
    {
        return Model::scenarios();
    }
    
    public function attributes()
    {
        return array_merge(parent::attributes(),['session_name', 'country_name', 'topic_name']);
    }

    public function search($params){
            $query = Docs::find();
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            $query->joinWith(['countries','topics','sessions']);
            $dataProvider->setSort([
                'defaultOrder'=>['date_council'=>SORT_DESC],
                'attributes' => [
                  'title',
                  'file'=>false,
                  'topic_name'=>[
                      'asc' => ['topics.topic' => SORT_ASC],
                      'desc' => ['topics.topic' => SORT_DESC],
                      'label' => 'Topic'
                  ],
                  'country_name'=>[
                      'asc' => ['countries.country' => SORT_ASC],
                      'desc' => ['countries.country' => SORT_DESC],
                      'label' => 'Country'
                  ],
                  'session_name' => [
                      'asc' => ['sessions.session_name' => SORT_ASC],
                      'desc' => ['sessions.session_name' => SORT_DESC],
                      'label' => 'Session Name'
                  ],
                  'date_council'
                ]
            ]);
                if (!($this->load($params) && $this->validate())) {
                    return $dataProvider;
                }
                $query->andFilterWhere(['like','countries.country', $this->country_name]);
                $query->andFilterWhere(['like','topics.topic', $this->topic_name]);
                $query->andFilterWhere(['like','sessions.session_name', $this->session_name]);
                $query->andFilterWhere(['like','title', $this->title]);
                $query->andFilterWhere(['like','date_council', $this->date_council]);
                return $dataProvider;
        }
}