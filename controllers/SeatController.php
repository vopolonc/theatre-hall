<?php


namespace app\controllers;


use app\entities\Hall;
use app\models\HallForm;
use app\services\HallService;
use Yii;
use yii\web\Controller;
use yii\base;

class SeatController extends Controller
{
    private $hallService;

    public function __construct($id, $module, $config = [])
    {
        $this->hallService = new HallService();
        parent::__construct($id, $module, $config);
    }

    public function actionInfo($row, $col)
    {
        $model = (Hall::find()->where(['row' => $row, 'col' => $col])->limit(1)->one());
        $model->created_at = date('Y-m-d H:i:s', $model->created_at);
        $model->scenario = Hall::SCENARIO_VIEW;
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $status = $model->delete();
            return [
                'success' => $status,
                'action' => 'delete',
                'row' => $row,
                'col' => $col,
            ];
        }
        return $this->renderAjax('_info', [
            'model' => $model,
        ]);
    }

    public function actionCreate($row, $col)
    {
        $model = new HallForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $status = $this->hallService->saveHall($model, $row, $col);
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'success' => $status,
                'action' => 'create',
                'row' => $row,
                'col' => $col,
            ];
        }

        return $this->renderAjax('_take-seat', [
            'model' => $model,
        ]);
    }

    public function actionSeat($row, $col)
    {

        if ((Hall::find()->where(['row' => $row, 'col' => $col])->limit(1)->one())) {
            return Yii::$app->runAction('seat/info', ['row' => $row, 'col' => $col]);
        }
        return Yii::$app->runAction('seat/create', ['row' => $row, 'col' => $col]);
    }
}