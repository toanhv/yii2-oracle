<?php

namespace backend\models;

use Yii;

class REPORTDAILY extends \common\models\REPORTDAILYBase {

    public static function getReportDaily($fromTime, $toTime, $type = 1) {
        $report = Yii::$app->db
                        ->createCommand("SELECT * FROM report_daily WHERE TYPE=:type and TRUNC(time) >= TO_DATE(:fromTime, 'yyyy-mm-dd') AND TRUNC(time) <= TO_DATE(:toTime, 'yyyy-mm-dd') ORDER BY time", [
                            'fromTime' => date('Y-m-d', strtotime($fromTime)),
                            'toTime' => date('Y-m-d', strtotime($toTime)),
                            'type' => intval($type),
                        ])->queryAll();
        $data = [];
        foreach ($report as $item) {
            $time = $item['TIME'];
            $item = json_decode($item['DATA'], true);
            $data[$time] = $item;
        }
        return $data;
    }

    public static function getReportMonthly($month) {
        $report = Yii::$app->db
                        ->createCommand("SELECT * FROM report_daily WHERE TYPE=2 and TO_CHAR(time, 'MM')= :month", [
                            'month' => $month
                        ])->queryOne();
        $data = [];
        $time = $report['TIME'];
        $item = json_decode($report['DATA'], true);
        $data[$time] = $item;
        return $data;
    }

}
