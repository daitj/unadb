<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'UNA Database';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docs-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= (Yii::$app->user->isGuest)?"":Html::a('Create new', ['site/create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php
$topics = ArrayHelper::map(app\models\Topics::find()->all(), 'topic','topic');
asort($topics);
$sessions = ArrayHelper::map(app\models\Sessions::find()->all(), 'session_name','session_name');
asort($sessions);
$countries = ArrayHelper::map(app\models\Countries::find()->all(), 'country','country');
asort($countries);
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'=>$searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            [
                'attribute'=>'topic_name',
                'filter'=> $topics,
                'value'=>'topics.topic',
            ],
            [
                'attribute'=>'country_name',
                'filter'=> $countries,
                'value'=>'countries.country'
            ],
            [
                'attribute'=>'session_name',
                'filter'=> $sessions,
                'value'=>'sessions.session_name'
            ],
            'date_council:date',
            ['attribute'=>'file','format'=>'raw','value'=>function($data){
                return Html::a('<span class="glyphicon glyphicon-paperclip"></span> Download','uploads/'.$data->doc_id.'_'.$data->file,['class'=>'']);
            }],
            [
                'class' => 'yii\grid\ActionColumn',
                'visible'=> !Yii::$app->user->isGuest,
                'template'=>'{update}{delete}',
            ],
        ],
    ]); ?>

</div>
