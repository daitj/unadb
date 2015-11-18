<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Sessions;
use app\models\Countries;
use app\models\Topics;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Docs */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="docs-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'topic_id')->dropDownList(ArrayHelper::map(Topics::find()->all(), 'topic_id', 'topic')) ?>
    
    <?= $form->field($model, 'country_id')->dropDownList(ArrayHelper::map(Countries::find()->all(), 'country_id', 'country')) ?>
    
    <?= $form->field($model, 'session_id')->dropDownList(ArrayHelper::map(Sessions::find()->all(), 'session_id', 'session_name')) ?>
    
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