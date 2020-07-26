<?php


namespace app\controllers;


use app\models\Hall;
use yii\base\DynamicModel;
use yii\web\Controller;

class SeatController extends Controller
{
    public function actionSeat($row, $col)
    {
        $model = new Hall();
        return $this->renderAjax('take-seat', [
            'row' => $row,
            'col' => $col,
            'model' => $model,
        ]);
    }
}