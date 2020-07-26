<?php

namespace app\controllers;

use app\entities\Hall;
use Yii;
use yii\base\DynamicModel;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * Retrieves hall with seats and render it
     */
    public function actionIndex()
    {
        $localSeats = Hall::find()->select(['row', 'col'])->asArray()->all();
        return $this->render('index', [
                'localSeats' => $localSeats,
            ]);
    }
}
