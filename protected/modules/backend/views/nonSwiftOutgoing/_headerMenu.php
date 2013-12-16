<div class="modifNavTab">
    <ul class="nav nav-tabs">
        <li <?php if ($this->action->id == 'umum'): ?>class="active"<?php endif; ?>><a href="<?php echo $this->vars['backendUrl'] . 'nonSwiftOutgoing/umum/' . $model->id; ?>">Umum</a></li>
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
                        <li><a href="<?php echo $this->vars['backendUrl'] . 'nonSwiftOutgoing/addPengirimNasabahPerorangan/' . $model->id; ?>">Perorangan</a></li>
                        <li><a href="<?php echo $this->vars['backendUrl'] . 'nonSwiftOutgoing/addPengirimNasabahKorporasi/' . $model->id; ?>">Korporasi</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Non Nasabah <span class="icon-caret-right caret-sub pull-right"></span>
                    </a>
                    <ul class="dropdown-menu sub-menu" role="menu">
                        <li><a href="<?php echo $this->vars['backendUrl'] . 'nonSwiftOutgoing/addPengirimNonNasabah/' . $model->id . '?is_diatas_seratus_juta=' . NonNasabahDn::IS_BESAR_DARI_SERATUS_JUTA_TIDAK; ?>">< 100 Juta</a></li>
                        <li><a href="<?php echo $this->vars['backendUrl'] . 'nonSwiftOutgoing/addPengirimNonNasabah/' . $model->id . '?is_diatas_seratus_juta=' . NonNasabahDn::IS_BESAR_DARI_SERATUS_JUTA_YA; ?>">> 100 Juta</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <?php if ($model->keterlibatanBeneficialOwner == $keterlibatanBeneficialOwner) : ?>
            <li class="dropdown <?php if ($this->action->id == 'addBeneficialOwnerNasabah' || $this->action->id == 'addBeneficialOwnerNonNasabah'): ?>active<?php endif; ?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Beneficial Owner <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo $this->vars['backendUrl'] . 'nonSwiftOutgoing/addBeneficialOwnerNasabah/' . $model->id; ?>">Nasabah</a></li>
                    <li><a href="<?php echo $this->vars['backendUrl'] . 'nonSwiftOutgoing/addBeneficialOwnerNonNasabah/' . $model->id; ?>">Non Nasabah</a></li>
                </ul>
            </li>
        <?php endif; ?>
        <li class="dropdown <?php if ($this->action->id == 'addPenerimaNasabahPerorangan' || $this->action->id == 'addPenerimaNasabahKorporasi' || $this->action->id == 'addPenerimaNonNasabah'): ?>active<?php endif; ?>">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                Identitas Penerima <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="icon-caret-right caret-sub pull-right"></span> Nasabah
                    </a>
                    <ul class="dropdown-menu sub-menu" role="menu">
                        <li><a href="<?php echo $this->vars['backendUrl'] . 'nonSwiftOutgoing/addPenerimaNasabahPerorangan/' . $model->id; ?>">Perorangan</a></li>
                        <li><a href="<?php echo $this->vars['backendUrl'] . 'nonSwiftOutgoing/addPenerimaNasabahKorporasi/' . $model->id; ?>">Korporasi</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo $this->vars['backendUrl'] . 'nonSwiftOutgoing/addPenerimaNonNasabah/' . $model->id; ?>">Non Nasabah</a></li>
            </ul>
        </li>
        <li <?php if ($this->action->id == 'addTransaksi'): ?>class="active"<?php endif; ?>><a href="<?php echo $this->vars['backendUrl'] . 'nonSwiftOutgoing/addTransaksi/' . $model->id; ?>">Transaksi</a></li>
        <li <?php if ($this->action->id == 'addInfoLain'): ?>class="active"<?php endif; ?>><a href="<?php echo $this->vars['backendUrl'] . 'nonSwiftOutgoing/addInfoLain/' . $model->id; ?>">Informasi Lainnya</a></li>
    </ul>
</div>