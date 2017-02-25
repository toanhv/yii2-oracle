<div>
    <h4 style="text-align: center;"><b>BÁO CÁO THÁNG</b></h4>
    <div>
        <form method="get" action="/report/monthly">
            Chọn tháng: 
            <select name="month">
                <?php for ($i = 1; $i < 13; $i++) { ?>
                    <option value="<?php echo $i; ?>" <?php echo ($i == $month) ? 'selected="selected"' : ''; ?>>Tháng <?php echo $i; ?></option>
                <?php } ?>
            </select>
            <input type="submit" name="REPORT" value="REPORT"/>
        </form>
    </div>
    <div style="overflow-x: auto; width: 99%;">
        <table style="table-layout: auto; min-width: 99%;" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid">
            <thead>
                <tr class="heading" role="row">
                    <th>Tiêu chí</th>
                    <th>Tháng <?php echo $month; ?></th>
                </tr>
            </thead>
            <colgroup>
                <col style="width: 20%;">
                <?php $i = 0; ?>
                <?php while ($i < sizeof($data)) { ?>
                    <col style="width: <?php echo 80 / sizeof($data); ?>%;">
                    <?php $i ++; ?>
                <?php } ?>
            </colgroup>
            <tbody>
                <tr class="odd" role="row" data-key="1">
                    <td><b>Tổng lượt mời</b></td>
                    <?php foreach ($data as $item) { ?>
                        <td><?php echo number_format($item['MONTHLY']['TONG_LUOT_MOI']); ?></td>
                    <?php } ?>
                </tr>
                <tr class="odd" role="row" data-key="1">
                    <td><b>Tổng thuê bao ứng</b></td>
                    <?php foreach ($data as $item) { ?>
                        <td><?php echo number_format($item['MONTHLY']['TONG_TB_UNG_TIEN']); ?></td>
                    <?php } ?>
                </tr>
                <tr class="odd" role="row" data-key="1">
                    <td><b>Tổng tiền ứng</b></td>
                    <?php foreach ($data as $item) { ?>
                        <td><?php echo number_format($item['MONTHLY']['TONG_TIEN_UNG']); ?></td>
                    <?php } ?>
                </tr>
                <tr class="odd" role="row" data-key="1">
                    <td><b>Tổng tiền hoàn</b></td>
                    <?php foreach ($data as $item) { ?>
                        <td><?php echo number_format($item['MONTHLY']['TONG_TIEN_HOAN']); ?></td>
                    <?php } ?>
                </tr>
            </tbody>
        </table>
        <h4>Chi tiết ứng</h4>
        <table style="table-layout: auto; min-width: 99%;" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid">
            <thead>
                <tr class="heading" role="row">
                    <th style="font-weight: bold; text-align: center; alignment-adjust: middle;">Mức ứng</th>
                    <th style="font-weight: bold; text-align: center; alignment-adjust: middle;">Số lượt ứng</th>
                    <th style="font-weight: bold; text-align: center; alignment-adjust: middle;">Số thuê bao ứng</th>
                </tr>
            </thead>
            <tbody>
                <?php $values = json_decode($item['MONTHLY']['CHI_TIET_UNG']); ?>
                <?php foreach ($values as $item) { ?>
                    <tr class="odd" role="row" data-key="1">
                        <td style="text-align: right;"><?php echo number_format($item->VALUE); ?></td>
                        <td style="text-align: right;"><?php echo number_format($item->TOTAL); ?></td>
                        <td style="text-align: right;"><?php echo number_format($item->MSISDN); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>