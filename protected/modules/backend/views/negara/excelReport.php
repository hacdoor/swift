<?php if ($model !== null): ?>
    <table>
        <thead>
            <tr>
                <th width="80px">id</th>
                <th width="80px">Nama</th>
                <th width="80px">Kode</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($model as $row): ?>
                <tr>
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $row->nama; ?></td>
                    <td><?php echo ($row->kode) ? $row->kode : ''; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>