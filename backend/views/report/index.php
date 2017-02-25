<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
?>
<div>
    <h4 style="text-align: center;"><b>BÁO CÁO NGÀY</b></h4>
    <div>        
        <?php $form = ActiveForm::begin(); ?>
        <?=
        $form->field($model, 'fromTime')->widget(DatePicker::classname(), [
            'language' => 'vi',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => [
                'readonly' => 'readonly',
                'style' => '',
            ]
        ])->label('Từ ngày')
        ?>

        <?=
        $form->field($model, 'toTime')->widget(DatePicker::classname(), [
            'language' => 'vi',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => [
                'readonly' => 'readonly',
                'style' => '',
            ]
        ])->label('Đến ngày')
        ?>
        <div class="form-group">
            <?= Html::submitButton('REPORT', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <?php if (sizeof($data)) { ?>
        <div style="overflow-x: auto; width: 99%;">
            <table style="table-layout: auto; min-width: 99%;" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid">
                <thead>
                    <tr class="heading" role="row">
                        <th style="font-weight: bold; text-align: center; alignment-adjust: middle;">Ngày</th>
                        <th style="font-weight: bold; text-align: center; alignment-adjust: middle;">Tổng lượt mời</th>
                        <th style="font-weight: bold; text-align: center; alignment-adjust: middle;">Tổng lượt ứng tiền</th>
                        <th style="font-weight: bold; text-align: center; alignment-adjust: middle;">Tổng lượt ứng tiền thành công</th>
                        <th style="font-weight: bold; text-align: center; alignment-adjust: middle;">Tổng thuê bao ứng</th>
                        <th style="font-weight: bold; text-align: center; alignment-adjust: middle;">Tổng tiền ứng</th>
                        <th style="font-weight: bold; text-align: center; alignment-adjust: middle;">Tổng tiền hoàn</th>
                        <th style="font-weight: bold; text-align: center; alignment-adjust: middle;">Tổng nợ sau 60 ngày không thu hồi</th>
                        <th style="font-weight: bold; text-align: center; alignment-adjust: middle;">Tổng phí thu hồi được</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $time => $item) { ?>
                        <tr class="odd" role="row" data-key="1">
                            <td><?php echo date('Y-m-d', strtotime($time)); ?></td>
                            <td style="text-align: right;"><?php echo number_format($item['DAILY']['TONG_LUOT_MOI']); ?></td>
                            <td style="text-align: right;"><?php echo number_format($item['DAILY']['TONG_LUOT_UNG_TIEN']); ?></td>
                            <td style="text-align: right;"><?php echo number_format($item['DAILY']['TONG_LUOT_UNG_TIEN_THANH_CONG']); ?></td>
                            <td style="text-align: right;"><?php echo number_format($item['DAILY']['TONG_TB_UNG_TIEN']); ?></td>
                            <td style="text-align: right;"><?php echo number_format($item['DAILY']['TONG_TIEN_UNG']); ?></td>
                            <td style="text-align: right;"><?php echo number_format($item['DAILY']['TONG_TIEN_HOAN']); ?></td>
                            <td style="text-align: right;"><?php echo number_format($item['DAILY']['NO_XAU']); ?></td>
                            <td style="text-align: right;"><?php echo number_format($item['DAILY']['PHI_THU_HOI']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>