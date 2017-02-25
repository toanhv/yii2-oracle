<?php

namespace console\models;

use common\models\REPORTDAILYBase;
use Yii;

class ReportDaily extends REPORTDAILYBase {

    public static function daily($fromDate = null, $toDate = null) {
        ini_set('memory_limit', '-1');
        date_default_timezone_set('Asia/Saigon');
        error_reporting(0);
        if (!$fromDate && !$toDate) {
            $fromDate = $toDate = date('Y-m-d', strtotime('-1 day'));
        }
        while (strtotime($fromDate) <= strtotime($toDate)) {
            $date = date('Y-m-d', strtotime($fromDate));
            $data = [];
            //Tong luot moi
            $query = Yii::$app->db
                            ->createCommand("select count(*) as total from ag_mt_his where lower(message) like 'tai khoan%' and trunc(RECEIVE_TIME) = trunc(to_date(:ngay, 'YYYY/MM/DD'))", [
                                'ngay' => $date
                            ])->queryOne();
            $data['DAILY']['TONG_LUOT_MOI'] = ($query) ? $query['TOTAL'] : 0;
            //Tong luot ung tien
            $query = Yii::$app->db
                            ->createCommand("select count(*) as total from ag_mo_his where upper(content) like 'U%' and trunc(receive_time) = trunc(to_date(:ngay, 'YYYY/MM/DD'))", [
                                'ngay' => $date
                            ])->queryOne();
            $data['DAILY']['TONG_LUOT_UNG_TIEN'] = ($query) ? $query['TOTAL'] : 0;
            //Tong luot ung tien thanh cong
            $query = Yii::$app->db
                            ->createCommand("select count(*) as total from ag_exchange_his where type = 9 and error_code = '0' and trans_type = 1 and trunc(insert_time) = trunc(to_date(:ngay, 'YYYY/MM/DD'))", [
                                'ngay' => $date
                            ])->queryOne();
            $data['DAILY']['TONG_LUOT_UNG_TIEN_THANH_CONG'] = ($query) ? $query['TOTAL'] : 0;
            //Tong thue bao ung
            $query = Yii::$app->db
                            ->createCommand("select count(distinct ISDN) as total from ag_mo_his where upper(content) like 'U%' and trunc(receive_time) = trunc(to_date(:ngay, 'YYYY/MM/DD'))", [
                                'ngay' => $date
                            ])->queryOne();
            $data['DAILY']['TONG_TB_UNG_TIEN'] = ($query) ? $query['TOTAL'] : 0;
            //Tong tien ung
            $query = Yii::$app->db
                            ->createCommand("select sum(value) as total from ag_exchange_his where type = 9 and error_code = '0' and trans_type = 1 and trunc(insert_time) = trunc(to_date(:ngay, 'YYYY/MM/DD'))", [
                                'ngay' => $date
                            ])->queryOne();
            $data['DAILY']['TONG_TIEN_UNG'] = ($query) ? $query['TOTAL'] : 0;
            //Tong tien hoan
            $query = Yii::$app->db
                            ->createCommand("select sum(value) as total from ag_exchange_his where type = 9 and error_code = '0' and trans_type = 0 and trunc(insert_time) = trunc(to_date(:ngay, 'YYYY/MM/DD'))", [
                                'ngay' => $date
                            ])->queryOne();
            $data['DAILY']['TONG_TIEN_HOAN'] = ($query) ? $query['TOTAL'] : 0;

            //Tổng nợ sau 60 ngày không thu hồi
            $query = Yii::$app->db
                            ->createCommand("select sum(loan_value - payback_value) as total from ag_loan where trunc(topup_time) <= trunc(to_date(:ngay, 'YYYY/MM/DD')) - 60 and payback_value < loan_value", [
                                'ngay' => $date
                            ])->queryOne();
            $data['DAILY']['NO_XAU'] = ($query) ? $query['TOTAL'] : 0;

            //Tổng phí thu hồi được
            $query = Yii::$app->db
                            ->createCommand("select sum(AMOUNT) as total from ag_cdr_exp where trans_type = 'PHI' and trunc(trans_time) = trunc(to_date(:ngay, 'YYYY/MM/DD'))", [
                                'ngay' => $date
                            ])->queryOne();
            $data['DAILY']['PHI_THU_HOI'] = ($query) ? $query['TOTAL'] : 0;

            //INSERT INTO DB
            $data = json_encode($data);
            $report = Yii::$app->db
                            ->createCommand("SELECT * FROM report_daily WHERE TYPE=1 and TRUNC(time) = TRUNC(to_date(:ngay, 'YYYY/MM/DD'))", [
                                'ngay' => $date
                            ])->queryOne();
            if ($report) {
                Yii::$app->db
                        ->createCommand("UPDATE report_daily SET data=:data, time = TRUNC(to_date(:ngay, 'YYYY/MM/DD')), UPDATED_DATE = sysdate WHERE type=1 and TRUNC(time) = TRUNC(to_date(:ngay, 'YYYY/MM/DD'))", [
                            'data' => $data,
                            'ngay' => $date
                        ])->execute();
            } else {
                Yii::$app->db
                        ->createCommand("INSERT INTO report_daily(type,data, time, UPDATED_DATE) VALUES (1,:data, TRUNC(to_date(:ngay, 'YYYY/MM/DD')), sysdate)", [
                            'data' => $data,
                            'ngay' => $date
                        ])->execute();
            }
            $fromDate = date('Y-m-d', strtotime($fromDate . ' +1 day'));
            echo "\n <br>[daily] report end for date " . $date;
        }
    }

    public static function monthly($month = null) {
        ini_set('memory_limit', '-1');
        date_default_timezone_set('Asia/Saigon');
        error_reporting(0);
        if (!$month) {
            $month = date('m');
        } else {
            $month = date('m', strtotime(date("y-$month-d")));
        }
        //Tong luot moi
        $query = Yii::$app->db
                        ->createCommand("select count(*) as total from ag_mt_his where lower(message) like 'tai khoan%' and TO_CHAR(RECEIVE_TIME, 'MM')= :month", [
                            'month' => $month
                        ])->queryOne();
        $data['MONTHLY']['TONG_LUOT_MOI'] = ($query) ? $query['TOTAL'] : 0;
        //Tong thue bao ung
        $query = Yii::$app->db
                        ->createCommand("select count(distinct ISDN) as total from ag_mo_his where upper(content) like 'U%' and TO_CHAR(receive_time, 'MM')= :month", [
                            'month' => $month
                        ])->queryOne();
        $data['MONTHLY']['TONG_TB_UNG_TIEN'] = ($query) ? $query['TOTAL'] : 0;
        //Tong tien ung
        $query = Yii::$app->db
                        ->createCommand("select sum(value) as total from ag_exchange_his where type = 9 and error_code = '0' and trans_type = 1 and TO_CHAR(insert_time, 'MM')= :month", [
                            'month' => $month
                        ])->queryOne();
        $data['MONTHLY']['TONG_TIEN_UNG'] = ($query) ? $query['TOTAL'] : 0;
        //Tong tien hoan
        $query = Yii::$app->db
                        ->createCommand("select sum(value) as total from ag_exchange_his where type = 9 and error_code = '0' and trans_type = 0 and TO_CHAR(insert_time, 'MM')= :month", [
                            'month' => $month
                        ])->queryOne();
        $data['MONTHLY']['TONG_TIEN_HOAN'] = ($query) ? $query['TOTAL'] : 0;
        //Chi tiet
        $query = Yii::$app->db
                        ->createCommand("select value, count(*) as total, count(distinct id_mapping) as msisdn from ag_exchange_his 
                                        where type = 9 and error_code = '0' and trans_type = 1 and TO_CHAR(insert_time, 'MM')= :month
                                        group by value order by value", [
                            'month' => $month
                        ])->queryAll();
        $data['MONTHLY']['CHI_TIET_UNG'] = json_encode($query);
        //INSERT INTO DB
        $data = json_encode($data);
        $report = Yii::$app->db
                        ->createCommand("SELECT * FROM report_daily WHERE TYPE=2 and TO_CHAR(time, 'MM')= :month", [
                            'month' => $month
                        ])->queryOne();
        if ($report) {
            Yii::$app->db
                    ->createCommand("UPDATE report_daily SET data=:data, time = TRUNC(to_date(:ngay, 'YYYY/MM/DD')), UPDATED_DATE = sysdate WHERE type=2 and TRUNC(time) = TRUNC(to_date(:ngay, 'YYYY/MM/DD'))", [
                        'data' => $data,
                        'ngay' => date("Y") . "/$month/01"
                    ])->execute();
        } else {
            Yii::$app->db
                    ->createCommand("INSERT INTO report_daily(type,data, time, UPDATED_DATE) VALUES (2,:data, TRUNC(to_date(:ngay, 'YYYY/MM/DD')), sysdate)", [
                        'data' => $data,
                        'ngay' => date("Y") . "/$month/01"
                    ])->execute();
        }
        echo "\n <br>[monthly] report end for month " . $month;
    }

}
