<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin(['id' => 'search-form', 'method' => 'get']); ?>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'first_name')->textInput(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'last_name')->textInput(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, "phone", [
                    'template' => ' {label}<div class="input-group">
                            <span class="input-group-addon">
                        <span class="glyphicon glyphicon-earphone"></span>+380</span>{input}</div>{error}{hint}']) ?>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Take seat', ['class' => 'btn btn-primary jsBeforeSubmitFormBtn', 'name' => '
                ']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
