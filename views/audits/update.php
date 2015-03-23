<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Audits */

$this->title = 'Update Audits: ' . ' ' . $model->audit_id;
$this->params['breadcrumbs'][] = ['label' => 'Audits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->audit_id, 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="audits-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
