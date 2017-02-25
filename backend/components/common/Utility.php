<?php

namespace backend\components\common;

use Yii;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Utility {

    public static function getFilePathToSave($filePath, $type) {
        if (is_file($filePath)) {
            $config = Yii::$app->params['upload'][$type]['basePath'];
            $file = explode($config, $filePath);
            return $config . $file[1];
        }
        return '';
    }

    public static function getBasePathUpload($type) {
        return Yii::$app->params['upload']['basePath'] . Yii::$app->params['upload'][$type]['basePath'];
    }

    public static function getPackageName($packageId) {
        $name = $packageId;
        switch (intval($packageId)) {
            case 1:
                $name = 'Gói ngày';
                break;
            case 2:
                $name = 'Gói tuần';
                break;
            case 3:
                $name = 'Gói tháng';
                break;
        }
        return $name;
    }

    public static function formatMsisdn($msisdn) {
        $msisdn = trim($msisdn);
        if (substr($msisdn, 0, 3) == '+84') {
            return substr($msisdn, 3);
        }
        if (substr($msisdn, 0, 1) == '0') {
            return substr($msisdn, 1);
        }
        if (substr($msisdn, 0, 2) == '84') {
            return substr($msisdn, 2);
        }
        return trim($msisdn);
    }

    public static function status2Text($status) {
        if ($status == '' || is_null($status)) {
            return 'Không tồn tại';
        }
        switch (intval($status)) {
            case 1:
                return 'Hoạt động';
                break;
            case 2:
                return 'Pending';
                break;
            case 3:
                return 'Pre-sub';
                break;
            case 0:
                return 'Đã hủy';
                break;
        }
        return $status;
    }

    public static function vcgwDetail($error) {
        $text = "Thất bại ($error)";
        switch (intval($error)) {
            case 0:
                $text = 'Thành công';
                break;
            case 401:
                $text = 'Thất bại (thiếu tiền)';
                break;
            case 205:
                $text = 'Thất bại (tiêu dùng thấp)';
                break;
        }
        return $text;
    }

}
