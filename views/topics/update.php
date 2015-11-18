<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Topics */

$this->title = 'Update Topics: ' . ' ' . $model->topic;
$this->params['breadcrumbs'][] = ['label' => 'Topics', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->topic, 'url' => ['view']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="topics-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
