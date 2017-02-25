<?php

namespace console\controllers;

use yii\console\Controller;

class ReportController extends Controller {

    public function actionDaily($fromDate = null, $toDate = null) {
        echo "\n REPORT START AT " . date('Y-m-d H:i:s');
        echo \console\models\ReportDaily::daily($fromDate, $toDate);
        echo "\n REPORT DONE AT " . date('Y-m-d H:i:s');
    }

    public function actionMonthly($month = null) {
        echo "\n REPORT START AT " . date('Y-m-d H:i:s');
        echo \console\models\ReportDaily::monthly($month);
        echo "\n REPORT DONE AT " . date('Y-m-d H:i:s');
    }

}
