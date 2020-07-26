<?php


namespace app\controllers;


use yii\base\DynamicModel;
use yii\web\Controller;

class SeatController extends Controller
{
    public function actionSeat($row, $col)
    {
        $model = new DynamicModel(['first_name', 'last_name', 'phone']);
        $model
            ->addRule(['first_name', 'phone', 'last_name'], 'required')
            ->addRule(['phone'], 'match', [
                'pattern' => '/^[0-9]{9}$/',
                'message' => 'Невірний формат. Повинен бути +380991234567']);
        return $this->renderAjax('take-seat', [
            'row' => $row,
            'col' => $col,
            'model' => $model,
        ]);
    }
}