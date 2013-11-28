<?php if ($model !== null): ?>
    <?php
    echo header('Content-Type: application/xml; charset=utf-8');
    ?>
    <negara>
        <?php foreach ($model as $row): ?>
            <id>
                <?php echo $row->id; ?>
            </id>
        <?php endforeach; ?>
    </negara>
<?php endif; ?>