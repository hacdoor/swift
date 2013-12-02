<?php if ($model !== null): ?>
    <table>
        <thead>
            <tr>
                <th width="80px">No.</th>
                <th width="80px">localId</th>
                <th width="80px">noLtdln</th>
                <th width="80px">tglLaporan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($model as $row):
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo ($row->localId) ? $row->localId : ''; ?></td>
                    <td><?php echo ($row->noLtdln) ? $row->noLtdln : ''; ?></td>
                    <td><?php echo Yii::app()->dateFormatter->formatDateTime($d->tglLaporan, 'long', null); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>