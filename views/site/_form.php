<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Docs */
/* @var $form yii\bootstrap\ActiveForm */
$topics = ArrayHelper::map(app\models\Topics::find()->all(), 'topic_id', 'topic');
asort($topics);
$countries = ArrayHelper::map(app\models\Countries::find()->all(), 'country_id', 'country');
asort($countries);
$sessions = ArrayHelper::map(app\models\Sessions::find()->all(), 'session_id', 'session_name');
asort($sessions);
?>

<div class="docs-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'topic_id')->dropDownList($topics) ?>
    
    <?= $form->field($model, 'file')->fileInput() ?>

    <?= $form->field($model, 'country_id')->dropDownList($countries) ?>
    
    <?= $form->field($model, 'session_id')->dropDownList($sessions) ?>
    
    <?= $form->field($model, 'date_council')->widget(
        DatePicker::className(), [
            'options'=>['class'=>'form-control'],
            'dateFormat' => 'yyyy-MM-dd 00:00:00',
            'clientOptions' => [
                'constrainInput'=> true,
            ]
    ]);?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>