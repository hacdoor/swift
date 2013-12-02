<?php if ($model !== null): ?>
    <table>
        <thead>
            <tr>
                <th width="80px">localId</th>
                <th width="80px">noLtdln</th>
                <th width="80px">tglLaporan</th>
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