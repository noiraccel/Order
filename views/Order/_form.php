<?php

use app\modules\order\models\Factory;
use app\modules\order\models\Status;
use app\modules\order\models\Worker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\order\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'factory_id')->textInput()->dropDownList(ArrayHelper::map(Factory::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'status_id')->textInput()->dropDownList(ArrayHelper::map(Status::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'user_id')->textInput()->dropDownList(ArrayHelper::map(Worker::find()->all(), 'id', 'fullname')) ?>

    <? // $form->field($model, 'created_at')->textInput() ?>

    <? // Comment: Убрал поле created_at, т.к заполняем автоматически, редактировать не стоит давать, сделал на своё усмотрение. ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
