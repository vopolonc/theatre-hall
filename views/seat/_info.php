<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin(['id' => 'search-form', 'method' => 'post']); ?>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'first_name')->textInput(['readonly' => true]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'last_name')->textInput(['readonly' => true]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'created_at')->textInput(['readonly' => true]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'phone')->textInput(['readonly' => true]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitButton('Make seat free', ['class' => 'btn btn-danger', 'name' => 'free-seat-btn']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>