<?php

namespace backend\components\common;

use SoapClient;
use yii\db\Exception;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class VtClientService {

    public static function validateVSA($username, $pass) {
        try {
            $client = new SoapClient(
                    \Yii::$app->params['vsa']['url']
            );

            $params = array(
                'userName' => $username,
                'password' => $pass,
                'domainCode' => 'IPCC'
            );
            $result = $client->validate($params)->return;
        } catch (Exception $e) {
            return array(
                'errorCode' => '1'
                , 'returnCode' => 'no'//no la fail, #no la thanh cong
            );
        }
        return array(
            'errorCode' => '0'
            , 'returnCode' => $result//no la fail, #no la thanh cong
        );
    }

    public static function register($phone_number, $subType, $channel, $isSentMT) {
        $result = ['errorCode' => 0];
        try {
            $client = new SoapClient(
                    \Yii::$app->params['webservice']['url']
            );

            $params = array(
                'phone_number' => $phone_number,
                'subType' => intval($subType),
                'channel' => $channel,
                'isSentMT' => intval($isSentMT)
            );
            $result['return'] = $client->subscribe2($params)->return;
        } catch (Exception $e) {
            return array(
                'errorCode' => 1
            );
        }
        return $result;
    }

    public static function processCharging($msisdn, $action, $content, $charge, $subType = 0, $channel = '') {
        $error = 445;
        $message = '';
        if ($msisdn) {
            $cmd = strtoupper($action);
            $msisdn = self::formatPhoneNumber($msisdn);
            $charge = intval($charge);
            ini_set('max_execution_time', 30);
            $content2 = $content;

            try {
                ini_set("soap.wsdl_cache_enabled", "0");
                $wsConfig = \Yii::$app->params['vcgw'];
                $soapClient = new SoapClient($wsConfig['url'], array('trace' => 1, "connection_timeout" => 90));
                $reqTime = date('YmdHis', strtotime("+1 seconds"));

                $params = Array(
                    'msisdn' => $msisdn,
                    'charging' => $charge,
                    'username' => $wsConfig['user'],
                    'password' => $wsConfig['pass'],
                    'reqTime' => $reqTime,
                    'providerid' => $wsConfig['providerid'],
                    'serviceId' => $wsConfig['serviceid'],
                    'cmd' => $cmd,
                    'contents' => substr($content2, 0, 99),
                    'requestId' => 1,
                );

                $result = $soapClient->__call("processCharging", array('parameters' => $params));
                $error = isset($result->return) ? $result->return : 445;
            } catch (Exception $ex) {
                $code = $ex->getCode();
                $error = $code ? intval($code) : 445;
                $message = nl2br($ex->getMessage());
            }

            self::logTransaction($msisdn, $cmd, $content, $charge, $error, $channel, $subType);
        }
        return array('error' => $error, 'message' => $message);
    }

    public static function formatPhoneNumber($msisdn) {
        if ((bool) preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', $msisdn) && !substr_compare($msisdn, '84', 0, 2)) {
            return substr($msisdn, 2);
        } else if ((bool) preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', $msisdn) && !substr_compare($msisdn, '0', 0, 1)) {
            return substr($msisdn, 1);
        }
        return $msisdn;
    }

    public static function logTransaction($msisdn, $cmd, $desc, $price, $result, $channel, $subType) {
        Yii::$app->db
                ->createCommand("INSERT INTO USER_TRANSACTION_LOGS (MSISDN, CMD, DESCRIPTIONS, PRICE, DATETIME, RESULT, TRANS_ID, CHANNEL, SUB_TYPE_ID)" + " VALUES (:MSISDN, :CMD, :DESCRIPTIONS, :PRICE, sysdate, :RESULT, :TRANS_ID, :CHANNEL, :SUB_TYPE_ID)", [
                    'MSISDN' => $msisdn,
                    'TRANS_ID' => 12,
                    'CMD' => $cmd,
                    'DESCRIPTIONS' => $desc,
                    'PRICE' => intval($price),
                    'RESULT' => $result,
                    'CHANNEL' => $channel,
                    'SUB_TYPE_ID' => intval($subType)
                ])
                ->execute();
    }

}
