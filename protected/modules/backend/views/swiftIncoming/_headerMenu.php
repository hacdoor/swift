<div class="modifNavTab">
    <ul class="nav nav-tabs">
        <li <?php if ($this->action->id == 'umum'): ?>class="active"<?php endif; ?>><a href="<?php echo $this->vars['backendUrl'] . 'swiftIncoming/umum/' . $model->id; ?>">Umum</a></li>
        <li class="dropdown <?php if ($this->action->id == 'addPengirimNasabahPerorangan' || $this->action->id == 'addPengirimNasabahKorporasi' || $this->action->id == 'addPengirimNonNasabah'): ?>active<?php endif; ?>">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                Identitas Pengirim <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Nasabah <span class="icon-caret-right caret-sub pull-right"></span>
                    </a>
                    <ul class="dropdown-menu sub-menu" role="menu">
                        <li><a href="<?php echo $this->vars['backendUrl'] . 'swiftIncoming/addPengirimNasabahPerorangan/' . $model->id; ?>">Perorangan</a></li>
                        <li><a href="<?php echo $this->vars['backendUrl'] . 'swiftIncoming/addPengirimNasabahKorporasi/' . $model->id; ?>">Korporasi</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo $this->vars['backendUrl'] . 'swiftIncoming/addPengirimNonNasabah/' . $model->id; ?>">Non Nasabah</a></li>
            </ul>
        </li>
        <li class="dropdown <?php if ($this->action->id == 'addPenerimaNasabahPerorangan' || $this->action->id == 'addPenerimaNasabahKorporasi' || $this->action->id == 'addPenerimaNasabahKorporasi'): ?>active<?php endif; ?>">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                Identitas Penerima <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <?php if ($model->pjkBankSebagai == $pjkBankSebagai) : ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="icon-caret-right caret-sub pull-right"></span> <?php echo Yii::app()->util->getKodeStandar(array('modul' => 'pjkBankSebagaiSwin', 'data' => $model->pjkBankSebagai)); ?>
                        </a>
                        <ul class="dropdown-menu sub-menu" role="menu">
                            <li><a href="<?php echo $this->vars['backendUrl'] . 'swiftIncoming/addPenerimaNasabahPerorangan/' . $model->id; ?>">Perorangan</a></li>
                            <li><a href="<?php echo $this->vars['backendUrl'] . 'swiftIncoming/addPenerimaNasabahKorporasi/' . $model->id; ?>">Korporasi</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo $this->vars['backendUrl'] . 'swiftIncoming/addPenerimaNonNasabah/' . $model->id; ?>">Non Nasabah</a></li>
                <?php else: ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="icon-caret-right caret-sub pull-right"></span> <?php echo Yii::app()->util->getKodeStandar(array('modul' => 'pjkBankSebagaiSwin', 'data' => $model->pjkBankSebagai)); ?>
                        </a>
                        <ul class="dropdown-menu sub-menu" role="menu">
                            <li><a href="<?php echo $this->vars['backendUrl'] . 'swiftIncoming/addPenerimaNasabahPerorangan/' . $model->id; ?>">Perorangan</a></li>
                            <li><a href="<?php echo $this->vars['backendUrl'] . 'swiftIncoming/addPenerimaNasabahKorporasi/' . $model->id; ?>">Korporasi</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </li>
        <li <?php if ($this->action->id == 'addTransaksi'): ?>class="active"<?php endif; ?>><a href="<?php echo $this->vars['backendUrl'] . 'swiftIncoming/addTransaksi/' . $model->id; ?>">Transaksi</a></li>
        <li <?php if ($this->action->id == 'addInfoLain'): ?>class="active"<?php endif; ?>><a href="<?php echo $this->vars['backendUrl'] . 'swiftIncoming/addInfoLain/' . $model->id; ?>">Informasi Lainnya</a></li>
    </ul>
</div>