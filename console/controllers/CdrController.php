<?php

namespace console\controllers;

use yii\console\Controller;

class CdrController extends Controller {

    public function actionIndex() {
        ini_set('memory_limit', '-1');
        error_reporting(0);
        $timeStart = date('Y-m-d H:i:s');
        \console\models\Cdr::export();
        $timeEnd = date('Y-m-d H:i:s');

        echo "\n START AT " . $timeStart;
        echo "\n DONE AT " . $timeEnd;
    }

    public function actionSub() {
        ini_set('memory_limit', '-1');
        error_reporting(0);
        $timeStart = date('Y-m-d H:i:s');
        \console\models\Sub::export();
        $timeEnd = date('Y-m-d H:i:s');

        echo "\n START AT " . $timeStart;
        echo "\n DONE AT " . $timeEnd;
    }

    public function actionCopy() {
        ini_set('memory_limit', '-1');
        error_reporting(0);
        $timeStart = date('Y-m-d H:i:s');
        \console\models\Syn::copy();
        $timeEnd = date('Y-m-d H:i:s');

        echo "\n START AT " . $timeStart;
        echo "\n DONE AT " . $timeEnd;
    }

    public function actionCrbt() {
        ini_set('memory_limit', '-1');
        error_reporting(0);
        $timeStart = date('Y-m-d H:i:s');
        \console\models\Syn::crbt();
        $timeEnd = date('Y-m-d H:i:s');

        echo "\n START AT " . $timeStart;
        echo "\n DONE AT " . $timeEnd;
    }

}
