<?php if ($model !== null): ?>
    <table>
        <thead>
            <tr>
                <th width="80px">Local Id</th>
                <th width="80px">No Ltdln</th>
                <th width="80px">Tgl. Laporan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo ($model->localId) ? $model->localId : ''; ?></td>
                <td><?php echo ($model->noLtdln) ? $model->noLtdln : ''; ?></td>
                <td><?php echo Yii::app()->dateFormatter->formatDateTime($model->tglLaporan, 'long', null); ?></td>
            </tr>
        </tbody>
    </table>
<?php endif; ?>