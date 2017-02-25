<?php

namespace backend\controllers;

use backend\controllers\AppController;
use Yii;

/**
 * Report controller
 */
class ReportController extends AppController {

    public function actionIndex() {
        $model = new \backend\models\ViewSearch();
        $model->fromTime = date('Y-m-d', strtotime('-7 day'));
        $model->toTime = date('Y-m-d');
        $reportData = \backend\models\REPORTDAILY::getReportDaily($model->fromTime, $model->toTime);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $reportData = \backend\models\REPORTDAILY::getReportDaily($model->fromTime, $model->toTime);
        }
        return $this->render('index', [
                    'data' => $reportData,
                    'model' => $model,
        ]);
    }

    public function actionMonthly() {
        if (!Yii::$app->user->isGuest) {
            $month = ($_GET && $_GET['month']) ? intval(trim($_GET['month'])) : date('m');
            if ($month < 0 || $month > 12) {
                $month = date('m');
            }
            $month = date('m', strtotime(date("y-$month-d")));
            $reportData = \backend\models\REPORTDAILY::getReportMonthly($month);

            return $this->render('monthly', [
                        'data' => $reportData,
                        'month' => $month,
            ]);
        }
        $this->redirect('/login');
    }

    public function actionRun() {
        $fromTime = ($_GET && $_GET['from']) ? date('Y-m-d', strtotime(trim($_GET['from']))) : null;
        $toTime = ($_GET && $_GET['to']) ? date('Y-m-d', strtotime(trim($_GET['to']))) : null;
        echo \console\models\ReportDaily::daily($fromTime, $toTime);
        echo \console\models\ReportDaily::monthly();
        echo '<br>Done<br>';
    }

    public function actionReportDaily() {
        $fromTime = ($_GET && $_GET['from']) ? date('Y-m-d', strtotime(trim($_GET['from']))) : null;
        $toTime = ($_GET && $_GET['to']) ? date('Y-m-d', strtotime(trim($_GET['to']))) : null;
        echo \console\models\ReportDaily::daily($fromTime, $toTime);
        echo '<br>Done<br>';
    }

    public function actionReportMonthly() {
        $month = ($_GET && $_GET['m']) ? intval($_GET['m']) : null;
        if ($month) {
            echo \console\models\ReportDaily::monthly($month);
        }
        echo '<br>Done<br>';
    }

}
