<?php if ($model !== null): ?>
    <?php
    echo header('Content-Type: application/xml; charset=utf-8');
    ?>
    <swift>
        <?php foreach ($model as $row): ?>
            <ifti type="<?php echo Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul' => 'swift', 'data' => $row->jenisSwift))); ?>">
                <localId><?php echo $row->localId; ?></localId>
                <umum>
                    <noLtdln><?php echo $row->noLtdln; ?></noLtdln>
                    <tglLaporan><?php echo Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul' => 'tanggal', 'data' => $row->tglLaporan))); ?></tglLaporan>
                    <namaPjk><?php echo $row->namaPjk; ?></namaPjk>
                    <namaPejabatPjk><?php echo $row->namaPejabatPjk; ?></namaPejabatPjk>
                    <jenisLaporan><?php echo Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul' => 'jenisLaporan', 'data' => $row->jenisLaporan))); ?></jenisLaporan>
                    <noLtdlnKoreksi><?php echo $row->noLtdlnKoreksi; ?></noLtdlnKoreksi>
                </umum>
                <pjkBankSebagai><?php echo Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul' => 'pjkBankSebagai', 'data' => $row->pjkBankSebagai))); ?></pjkBankSebagai>
                <identitasPengirim>
                    <?php
                    $identitasPengirimSwIn = IdentitasPengirimSwIn::model()->find('swift_id=' . $row->id);
                    if ($identitasPengirimSwIn) {
                        if ($identitasPengirimSwIn->jenis == 1) {
                            echo '<nasabah>';
                            $nasabahPengirimSwIn = NasabahPengirimSwIn::model()->find('identitasPengirimSwIn_id=' . $identitasPengirimSwIn->id);
                            if ($nasabahPengirimSwIn->jenis == 1) {
                                echo '<perorangan>';
                                $peroranganPengirimSwIn = PeroranganPengirimSwIn::model()->find('nasabahPengirimSwIn_id=' . $nasabahPengirimSwIn->id);
                                if ($peroranganPengirimSwIn) {
                                    $tglLahir = Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul' => 'tanggal', 'data' => $peroranganPengirimSwIn->tglLahir)));
                                    $kewarganegaraan = Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul' => 'kewarganegaraan', 'data' => $peroranganPengirimSwIn->kewarganegaraan)));
                                    echo "
                                    <noRekening>$peroranganPengirimSwIn->noRekening</noRekening>
                                    <namaLengkap>$peroranganPengirimSwIn->namaLengkap</namaLengkap>
                                    <tglLahir>$tglLahir</tglLahir>
                                    <kewarganegaraan>
                                      <wargaNegara>$kewarganegaraan</wargaNegara>
                                      <idNegara>$peroranganPengirimSwIn->idNegaraKewarganegaraan</idNegara>
                                      <negaraLain>$peroranganPengirimSwIn->negaraLainnyaKewarganegaraan</negaraLain>
                                    </kewarganegaraan>
                                    <alamatSesuaiVoucher>
                                      <alamat>$peroranganPengirimSwIn->alamat</alamat>
                                      <negaraBagianKota>$peroranganPengirimSwIn->negaraBagianKota</negaraBagianKota>
                                      <idNegara>$peroranganPengirimSwIn->idNegaraBagianKota</idNegara>
                                      <negaraLain>$peroranganPengirimSwIn->negaraLainnyaBagianKota</negaraLain>
                                    </alamatSesuaiVoucher>
                                    <noTelp>$peroranganPengirimSwIn->noTelp</noTelp>
                                    <buktiIdentitas>
                                      <ktp>$peroranganPengirimSwIn->ktp</ktp>
                                      <sim>$peroranganPengirimSwIn->sim</sim>
                                      <passport>$peroranganPengirimSwIn->passport</passport>
                                      <kimsKitasKitap>$peroranganPengirimSwIn->kimsKitasKitab</kimsKitasKitap>
                                      <npwp>$peroranganPengirimSwIn->npwp</npwp>
                                      <buktiLain>
                                        <jenisBuktiLain>$peroranganPengirimSwIn->jenisBuktiLain</jenisBuktiLain>
                                        <noBuktiLain>$peroranganPengirimSwIn->noBuktiLain</noBuktiLain>
                                      </buktiLain>
                                    </buktiIdentitas>
                                    ";
                                } else {
                                    echo $peroranganPengirimSwInTemplate;
                                }
                                echo '</perorangan>';
                                echo "<korporasi>$korporasiPengirimSwInTemplate</korporasi>";
                            } else {
                                echo "<perorangan>$peroranganPengirimSwInTemplate</perorangan>";
                                echo '<korporasi>';
                                $korporasiPengirimSwIn = KorporasiPengirimSwIn::model()->find('nasabahPengirimSwIn_id=' . $nasabahPengirimSwIn->id);
                                if ($korporasiPengirimSwIn) {
                                    echo "                    
                                            <noRekening>$korporasiPengirimSwIn->noRekening</noRekening>
                                            <namaKorporasi>$korporasiPengirimSwIn->namaKorporasi</namaKorporasi>
                                            <alamatSesuaiVoucher>
                                              <alamat>$korporasiPengirimSwIn->alamat</alamat>
                                              <negaraBagianKota>$korporasiPengirimSwIn->negaraBagianKota</negaraBagianKota>
                                              <idNegara>$korporasiPengirimSwIn->idNegaraBagianKota</idNegara>
                                              <negaraLain>$korporasiPengirimSwIn->negaraLainnyaBagianKota</negaraLain>
                                            </alamatSesuaiVoucher>
                                            <noTelp>$korporasiPengirimSwIn->noTelp</noTelp>

                                    ";
                                } else {
                                    echo $korporasiPengirimSwInTemplate;
                                }
                                echo '</korporasi>';
                            }
                            echo '</nasabah>';
                            echo "<nonNasabah>$nonNasabahPengirimSwInTemplate</nonNasabah>";
                        } else {
                            echo "<nasabah><perorangan>$peroranganPengirimSwInTemplate</perorangan><korporasi>$korporasiPengirimSwInTemplate</korporasi></nasabah>";
                            echo '<nonNasabah>';
                            $nonNasabahPengirimSwIn = NonNasabahPengirimSwIn::model()->find('identitasPengirimSwIn_id=' . $identitasPengirimSwIn->id);
                            if($nonNasabahPengirimSwIn){
                                $tglLahir = Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul' => 'tanggal', 'data' => $nonNasabahPengirimSwIn->tglLahir)));
                                echo "
                                    <noRekening>$nonNasabahPengirimSwIn->noRekening</noRekening>
                                    <namaLengkap>$nonNasabahPengirimSwIn->namaLengkap</namaLengkap>
                                    <tglLahir>$tglLahir</tglLahir>
                                    <alamatSesuaiVoucher>
                                      <alamat>$nonNasabahPengirimSwIn->alamat</alamat>
                                      <negaraBagianKota>$nonNasabahPengirimSwIn->negaraBagianKota</negaraBagianKota>
                                      <idNegara>$nonNasabahPengirimSwIn->idNegaraBagianKota</idNegara>
                                      <negaraLain>$nonNasabahPengirimSwIn->negaraLainnyaBagianKota</negaraLain>
                                    </alamatSesuaiVoucher>
                                    <noTelp>$nonNasabahPengirimSwIn->noTelp</noTelp>
                                ";
                            }else{
                                echo $nonNasabahPengirimSwInTemplate;
                            }
                            echo '</nonNasabah>';
                        }
                    }
                    ?>
                </identitasPengirim>
            </ifti>
        <?php endforeach; ?>
    </swift>
<?php endif; ?>