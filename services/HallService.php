<?php

namespace app\services;

use app\entities\Hall;
use yii\helpers\ArrayHelper;

class HallService
{
    /**
     * Retrieves data from From model and populate it to save model and save it
     *
     * @param $formModel
     * @param $row
     * @param $col
     * @return bool
     * @throws \Exception
     */
    final public function saveHall($formModel, $row, $col)
    {
        $model = new Hall(['scenario' => Hall::SCENARIO_CREATE]);
        $model->first_name = ArrayHelper::getValue($formModel, 'first_name');
        $model->last_name = ArrayHelper::getValue($formModel, 'last_name');
        $model->phone = ArrayHelper::getValue($formModel, 'phone');
        $model->row = $row;
        $model->col = $col;
        $model->created_at = time();
        return $model->save();
    }
}