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

    /**
     * [Hall Service] should be init like a DI container.
     * SeatController constructor.
     * @param $id
     * @param $module
     * @param array $config
     */
//    public function __construct($id, $module, HallService $hallService,  $config = [])
    public function __construct($id, $module, $config = [])
    {
//        $this->hallService = $hallService;
        $this->hallService = new HallService();
        parent::__construct($id, $module, $config);
    }

    /**
     * Shows data about occupied seat (by row and col)
     * Also makes
     * @param $row
     * @param $col
     * @return string|\yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionInfo($row, $col)
    {
        $model = (Hall::find()->where(['row' => $row, 'col' => $col])->limit(1)->one());
        $model->created_at = date('Y-m-d H:i:s', $model->created_at);
        $model->scenario = Hall::SCENARIO_VIEW;
        if (Yii::$app->request->isPost) {
            $status = $model->delete();
            Yii::$app->session->setFlash($status ? 'success' : 'error', $status ? "Seat freed." : "Seat cannot be freed.");
            return $this->redirect(['/']);
        }
        return $this->renderAjax('_info', [
            'model' => $model,
        ]);
    }

    /**
     * Creates new seat cell and saved it
     *
     * @param $row
     * @param $col
     * @return string|\yii\web\Response
     */
    public function actionCreate($row, $col)
    {
        $model = new HallForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $status = $this->hallService->saveHall($model, $row, $col);
            Yii::$app->session->setFlash($status ? 'success' : 'error', $status ? "Seat saved." : "Seat cannot be saved.");
            return $this->redirect(['/']);
        }

        return $this->renderAjax('_take-seat', [
            'model' => $model,
        ]);
    }

    /**
     * Proxy action directs request to correct action [create/info]
     * depending on seat state (occupied or empty)
     * @param $row
     * @param $col
     * @return int|mixed|\yii\console\Response
     * @throws \yii\console\Exception
     * @throws base\InvalidRouteException
     */
    public function actionSeat($row, $col)
    {

        if ((Hall::find()->where(['row' => $row, 'col' => $col])->limit(1)->one())) {
            return Yii::$app->runAction('seat/info', ['row' => $row, 'col' => $col]);
        }
        return Yii::$app->runAction('seat/create', ['row' => $row, 'col' => $col]);
    }
}