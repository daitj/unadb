<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Audits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audits-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'=>$searchModel,
        'columns' => [
            ['attribute'=>'doc_title','label'=>'Document','value'=>'docs.title'],
            'audit_type',
            ['attribute'=>'user_name','label'=>'Username','value'=>'user.username'],
            'time',
            [
                'class' => 'yii\grid\ActionColumn',
                'visible'=> Yii::$app->user->identity->getIsAdmin(),
                'template'=>'{update}',
            ],
        ],
    ]); ?>

</div>
