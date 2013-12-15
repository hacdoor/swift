<?php

class UtilComponent extends CApplicationComponent {

    public function init() {
        
    }

    public function obfuscate($str) {
        $str = str_replace('#', '', $str);
        $length = strlen($str);
        $obfuscated = '';
        for ($i = 0; $i < $length; $i++)
            $obfuscated .= "&#" . ord($str[$i]);
        return $obfuscated;
    }

    function xssClean($data) {
        // Fix &entity\n;
        $data = str_replace(array('&', '<', '>'), array('&amp;', '&lt;', '&gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');
        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);
        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);
        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
        do {
            // Remove really unwanted tags
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        } while ($old_data !== $data);
        // we are done...
        return $data;
    }

    function slugify($str, $replace = array(), $delimiter = '-') {
        setlocale(LC_ALL, 'en_US.UTF8');
        if (!empty($replace)) {
            $str = str_replace((array) $replace, ' ', $str);
        }

        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return $clean;
    }

    function encryptPassword($str) {
        return hash('sha1', $str . Yii::app()->setting->get('salt'));
    }

    function generateRandom($length = 7) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $string = '';

        for ($p = 0; $p < $length; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string;
    }

    public function purify($text, $config = 'title') {
        $ret = $text;

        if ($config) {
            $purifier = new CHtmlPurifier();
            switch ($config) {
                case 'title':
                    $purifier->options = array(
                        'HTML.Allowed' => Yii::app()->setting->get('title_filter'),
                    );
                    break;
                case 'teaser':
                    $purifier->options = array(
                        'HTML.Allowed' => Yii::app()->setting->get('teaser_filter'),
                    );
                    break;
                case 'body':
                    $purifier->options = array(
                        'HTML.Allowed' => Yii::app()->setting->get('body_filter'),
                    );
                    break;
                case 'comment':
                    $purifier->options = array(
                        'HTML.Allowed' => Yii::app()->setting->get('comment_filter'),
                    );
                    break;
            }
            $ret = $purifier->purify($text);
        } else {
            $ret = CHtml::encode($text);
        }

        return $ret;
    }

    public function generateImage($image, $sourceFolder, $preset, $default = 'default.png') {
        $ret = '';
        $assetsPath = YiiBase::getPathOfAlias('webroot');
        $assetsPath .= '/' . Yii::app()->setting->get('assets_path');

        if (!empty($image)) {
            if (!file_exists($assetsPath . '/' . Yii::app()->setting->get('imagecache_path') . '/' . $preset . '/' . $image)) {
                if (file_exists($assetsPath . '/' . $sourceFolder . '/' . $image)) {
                    Yii::app()->imageapi->createUrl($preset, $assetsPath . '/' . $sourceFolder . '/' . $image);
                } else {
                    if ($default) {
                        $image = $default;
                        if (!empty($image)) {
                            if (!file_exists(YiiBase::getPathOfAlias('webroot.' . Yii::app()->setting->get('assets_path') . '.' . $sourceFolder . '.' . $preset) . '/' . $image)) {
                                Yii::app()->imageapi->createUrl($preset, $assetsPath . '/' . $sourceFolder . '/' . $image);
                            }
                            $ret = Yii::app()->request->baseurl . '/' . Yii::app()->setting->get('assets_path') . '/' . Yii::app()->setting->get('imagecache_path') . '/' . $preset . '/' . $image;
                        }
                    }
                }
            }
            $ret = Yii::app()->request->baseurl . '/' . Yii::app()->setting->get('assets_path') . '/' . Yii::app()->setting->get('imagecache_path') . '/' . $preset . '/' . $image;
        } else {
            if ($default) {
                $image = $default;
                if (!empty($image)) {
                    if (!file_exists(YiiBase::getPathOfAlias('webroot.' . Yii::app()->setting->get('assets_path') . '.' . $sourceFolder . '.' . $preset) . '/' . $image)) {
                        Yii::app()->imageapi->createUrl($preset, $assetsPath . '/' . $sourceFolder . '/' . $image);
                    }
                    $ret = Yii::app()->request->baseurl . '/' . Yii::app()->setting->get('assets_path') . '/' . Yii::app()->setting->get('imagecache_path') . '/' . $preset . '/' . $image;
                }
            }
        }

        return str_replace('\ ', ' ', $ret);
    }

    public function deleteAssetsFile($filename, $folder) {
        $assetsPath = YiiBase::getPathOfAlias('webroot');
        $assetsPath .= '/' . Yii::app()->setting->get('assets_path');
        return @unlink($assetsPath . '/' . $folder . '/' . $filename);
    }

    public function validateDate($date) {
        if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $date, $matches)) {
            if (checkdate($matches[2], $matches[3], $matches[1])) {
                return true;
            }
        }
        return false;
    }

    public function setLog($data_type, $data_id, $data_action, $data_diff = null) {
        $flag = TRUE;
        $user = Yii::app()->user->getState('admin');
        $user_id = $user->id;
        $user_name = $user->username;
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $ip = $_SERVER['REMOTE_ADDR'];
        if ($data_action === 'Edit data') {
            $old = $data_diff['old'];
            $new = $data_diff['new'];
            $label = $data_diff['label'];
            $diff = array_diff($old, $new);
            $data_diff = PHP_EOL . count($diff) . ' Data yang berubah :';
            if ($diff) {
                foreach ($diff as $key => $value) {
                    $data_diff .= PHP_EOL . '[' . $label[$key] . '] ' . $value . ' menjadi ' . $new[$key];
                }
            } else {
                $flag = FALSE;
            }
        }
        $remark = $user_name . '(' . $user_id . ') Melakukan ' . $data_action . ' id(' . $data_id . ')  pada modul ' . $data_type . $data_diff;
        $data = array(
            'user_id' => $user_id,
            'data_type' => $data_type,
            'data_id' => $data_id,
            'data_action' => $data_action,
            'ip' => $ip,
            'user_agent' => $user_agent,
            'remark' => $remark,
        );
        if ($flag) {
            //$ci->db->insert('log', $data);
            $filename = 'log/logAktifitas.txt';
            if (!file_exists($filename)) {
                file_put_contents($filename, '');
            }
            $somecontent = "\n========================================================================================================================";
            $somecontent .= "\nIP: " . $ip;
            $somecontent .= "\nUser Agent: " . $user_agent;
            $somecontent .= "\nTime: " . date("H:i:s d-m-Y");
            $somecontent .= "\n" . $remark;
            $somecontent .= "\n========================================================================================================================\n";

            if (is_writable($filename)) {


                if (!$handle = fopen($filename, 'a')) {
                    exit;
                }

                // Write $somecontent to our opened file.
                if (fwrite($handle, $somecontent) === FALSE) {
                    exit;
                }
                fclose($handle);
            }
        }
    }

    public function getNumberSwift($param) {
        $number = '';
        switch ($param) {
            case 1:
                $number = 'swin' . '/' . $this->generateRandom(5);
                break;
            case 2:
                $number = 'swout' . '/' . $this->generateRandom(5);
                break;
            case 3:
                $number = 'nonswin' . '/' . $this->generateRandom(5);
                break;
            case 4:
                $number = 'nonswout' . '/' . $this->generateRandom(5);
                break;
            default:
                break;
        }
        return $number;
    }

    public function buildDropDown($param) {
        $data = array('' => 'Pilih');
        foreach ($param as $key => $value) {
            $data[$key] = $value;
        }
        return $data;
    }

    public function buildDropDownSelect($param, $data) {
        $id = str_replace('[', '_', $data['name']);
        $id = str_replace(']', '', $id);

        $class = '';
        if (isset($data['class'])):
            $class = $data['class'];
        endif;

        $str = '<select class="form-control ' . $class . '"  id="' . $id . '" name="' . $data['name'] . '">';
        $str .= '<option value="">Pilih</option>';
        foreach ($param as $key => $value) {
            $data[$key] = $value;
            $sel = '';
            if (intval($key) == intval($data['value']))
                $sel = 'selected="selected"';
            $str .= '<option value="' . $key . '" ' . $sel . ' >' . $value . '</option>';
        }
        $str .= '</select>';
        return $str;
    }

    public function getKodeStandar($param) {
        if ($param['modul'] === 'tanggal') {
            return date('d/m/Y', strtotime($param['data']));
        } elseif ($param['modul'] === 'propinsi') {
            $result = array();
            $d = Propinsi::model()->findAll();
            foreach ($d as $key => $value) {
                $result[$value->id] = $value->nama;
            }
            $data = $result;
        } elseif ($param['modul'] === 'kabupaten') {
            $result = array();
            $d = Kabupaten::model()->findAll();
            foreach ($d as $key => $value) {
                $result[$value->id] = $value->nama;
            }
            $data = $result;
        } elseif ($param['modul'] === 'negara') {
            $result = array();
            // $criteria = new CDbCriteria;
            // $criteria->order = 'nama ASC';
            $d = Negara::model()->findAll();
            foreach ($d as $key => $value) {
                $result[$value->id] = $value->nama;
            }
            $data = $result;
        } elseif ($param['modul'] === 'mataUang') {
            $result = array();
            $d = MataUang::model()->findAll();
            foreach ($d as $key => $value) {
                $result[$value->id] = $value->nama;
            }
            $data = $result;
        } else {
            $modul = array(
                'jenisLaporan' => array(1 => 'Baru', 2 => 'Koreksi', 3 => 'Recall', 4 => 'Reject'),
                'kewarganegaraan' => array(1 => 'WNI', 2 => 'WNA'),
                'bentukBadanUsaha' => array(1 => 'CV', 2 => 'PT', 3 => 'Yayasan', 9 => 'Lainnya'),
                'pjkBankSebagaiSwin' => array(1 => 'Penyelenggara Penerima Akhir', 2 => 'Penyelenggara Penerus'),
                'pjkBankSebagaiSwout' => array(1 => 'Penyelenggara Pengirim Akhir', 2 => 'Penyelenggara Penerus'),
                'pekerjaan' => array(
                    1 => 'Pejabat Lembaga Legislatif dan Pemerintah',
                    2 => 'PNS (termasuk pensiunan)',
                    3 => 'TNI/Polri (termasuk pensiunan)',
                    4 => 'Pegawai BI/BUMN/BUMD (termasuk pensiunan)',
                    5 => 'Pengurus Parpol',
                    6 => 'Pegawai Swasta',
                    7 => 'Profesional dan Konsultan',
                    8 => 'Pengajar dan Dosen',
                    9 => 'Pengusaha/Wiraswasta',
                    10 => 'Pedagang',
                    11 => 'Petani dan Nelayan',
                    12 => 'Pengrajin',
                    13 => 'Buruh, Pembantu Rumah Tangga dan Tenaga Keamanan',
                    14 => 'Ibu Rumah Tangga',
                    15 => 'Pelajar/Mahasiswa',
                    16 => 'Pengurus dan pegawai yayasan/lembaga berbadan hukum lainnya',
                    17 => 'Pengurus/Pegawai LSM/organisasi tidak berbadan hukum lainnya',
                    18 => 'Ulama/Pendeta/Pimpinan organisasi dan kelompok keagamaan',
                    19 => 'Lain-Lain',
                ),
                'bidangUsaha' => array(
                    1 => 'Pertanian',
                    2 => 'Perikanan',
                    3 => 'Peternakan',
                    4 => 'Kehutanan dan Pemotongan Kayu',
                    5 => 'Pertambangan',
                    6 => 'Perindustrian',
                    7 => 'Listrik',
                    8 => 'Gas',
                    9 => 'Air',
                    10 => 'Konstruksi',
                    11 => 'Ekspor/Impor',
                    12 => 'Distribusi',
                    13 => 'Perdagangan Eceran',
                    14 => 'Restoran dan Hotel',
                    15 => 'Pengangkutan Umum',
                    16 => 'Biro Perjalanan',
                    17 => 'Real Estate',
                    18 => 'Konsultan',
                    19 => 'Hiburan dan Kebudayaan',
                    20 => 'Kesehatan',
                    21 => 'Pendidikan',
                    22 => 'Lainnya',
                ),
                'swift' => array(
                    'SwIn' => 'Swift Incoming',
                    'SwOut' => 'Swift Outgoing',
                    'NonSwIn' => 'Non Swift Incoming',
                    'NonSwOut' => 'Non Swift Outgoing',
                    '1' => 'SwiftIncoming',
                    '2' => 'SwiftOutgoing',
                    '3' => 'NonSwiftIncoming',
                    '4' => 'NonSwiftOutgoing'
                ),
                'swiftStatus' => array(
                    '1' => 'Draft',
                    '2' => 'Finalize',
                ),
                'upload' => array('person' => 'Nasabah Perorangan', 'trx' => 'Transaksi', 'kyc' => 'Nasabah Korporasi')
            );
            $data = $modul[$param['modul']];
        }

        if ($param['data'] === 'all')
            return $data;
        elseif ($param['data'] === 'all&blank')
            return $this->buildDropDown($data);
        elseif (is_array($param['data']))
            return $this->buildDropDownSelect($data, $param['data']);
        else {
            if (array_key_exists($param['data'], $data)) {
                return $data[$param['data']];
            } else {
                foreach ($data as $key => $value) {
                    return $value;
                }
            }
        }
    }

    public function cleanString($param) {
        $t = str_replace('|', '', $param);
        $t = str_replace('-', '', $t);
        $t = explode(' ', $t);
        $k = array('T', 'O', 'P', 'U', 'R', 'G', 'E', 'N', 'T');
        if (is_array($t)) {
            $data = array();
            foreach ($t as $v) {
                if (strlen($v) > 1 || is_numeric($v) || $v === '.' || $v === 'T' || $v === 'O' || $v === 'P' || $v === 'U' || $v === 'R' || $v === 'G' || $v === 'E' || $v === 'N') {
                    $data[] = $v;
                }
            }
            return implode(' ', $data);
        } else {
            return $param;
        }
    }

    public function getSwiftData($param) {
        $data = array();
        if (is_array($param) && count($param) > 1) {
            $k = 0;
            $t_data = array();
            foreach ($param as $value) {
                if (empty($value)) {
                    $k++;
                } else {
                    $t_data[$k][] = $value;
                }
            }
            if (is_array($t_data) && count($t_data) > 1) {
                $data['info']['countSwIn'] = 0;
                $data['info']['countSwOut'] = 0;
                foreach ($t_data as $value) {
                    if (key_exists(1, $value)) {
                        $temp = $value[1];
                        $in = substr_count($temp, '2:O103');
                        if ($in) {
                            $data['data']['swIn'][] = $value;
                        } else {
                            $out = substr_count($temp, '2:I103');
                            if ($out) {
                                $data['data']['swOut'][] = $value;
                            }
                        }
                    }
                }
                if (key_exists('swIn', $data['data'])) {
                    $data['info']['countSwIn'] = count($data['data']['swIn']);
                }
                if (key_exists('swOut', $data['data'])) {
                    $data['info']['countSwOut'] = count($data['data']['swOut']);
                }
            }
        }
        return $data;
    }

    public function getPersonData($param) {
        $data = array();
        $temp = array();
        $data['info'] = 0;
        foreach ($param as $key => $value) {
            if (preg_match_all('`"([^"]*)"`', $value, $result)) {
                foreach ($result[1] as $r) {
                    $replace = '';
                    if (substr_count($r, '.00')) {
                        $replace = (int) preg_replace("/([^0-9\\.])/i", "", $r);
                    } else {
                        $replace = str_replace(',', $replace, $r);
                    }
                    $value = str_replace($r, $replace, $value);
                }
            }
            $exp = explode(',', $value);
            $temp[$key] = $exp;
        }
        $data['label'] = $temp[0];
        array_shift($temp);
        $data['info'] = count($temp);
        $data['data'] = $temp;
        return $data;
    }

    public function actionCreatefile($filename, $filelist) {
        $zip = new ZipArchive();
        $destination = 'download/' . $filename;
        if ($zip->open($destination, ZIPARCHIVE::CREATE) !== true) {
            return false;
        }

        foreach ($filelist as $file) {
            if (file_exists($file)) {
                $new = explode('/', $file);
                $zip->addFile($file, end($new));
            }
        }
        $zip->close();
        foreach ($filelist as $file) {
            if (file_exists($file))
                unlink($file);
        }

        if (file_exists($destination)) {
            header('Content-type: application/zip');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            readfile($destination);
            unlink($destination);
        }
    }

    public function getFormXml($param) {
        switch ($param->jenisSwift) {
            case 1:
                return $this->getFormSwInXml($param);
                break;
            case 2:
                return $this->getFormSwOutXml($param);
                break;
            default:
                break;
        }
    }

    public function getFormSwOutXml($param) {
        /* ============================ UMUM ======================================== */
        $umum = $this->getFormUmumXml(array(
            Yii::app()->util->getKodeStandar(array('modul' => 'tanggal', 'data' => $param->tglLaporan)),
            $param->namaPejabatPjk,
            $param->jenisLaporan,
            $param->pjkBankSebagai
                ));

        /* ============================ END UMUM ====================================== */


        /* ============================ IDENTITAS PENGIRIM ============================ */
        $kewarganegaraanPeroranganPengirim = $this->getFormKewarganegaraanXml(array());
        $alamatSesuaiVoucherPeroranganPengirim = $this->getFormAlamatXml(array());

        $buktiLainPeroranganPengirim = $this->getFormBuktiLainXml(array());
        $buktiIdentitasPeroranganPengirim = $this->getFormBuktiIdentitasXml(array(5 => $buktiLainPeroranganPengirim));

        $peroranganPengirim = $this->getFormPeroranganXml(array(
            3 => $kewarganegaraanPeroranganPengirim,
            4 => $alamatSesuaiVoucherPeroranganPengirim,
            6 => $buktiIdentitasPeroranganPengirim
                ));
        $alamatSesuaiVoucherKorporasiPengirim = $this->getFormAlamatXml(array());

        $korporasiPengirim = $this->getFormKorporasiXml(array(2 => $alamatSesuaiVoucherKorporasiPengirim));

        $alamatSesuaiVoucherNonNasabahPengirim = $this->getFormAlamatXml(array());
        $nonNasabahPengirim = $this->getFormNonNasabahXml(array(4 => $alamatSesuaiVoucherNonNasabahPengirim));
        $nasabahPengirim = $this->getFormIdentitasXml(array($peroranganPengirim, $korporasiPengirim), 1);

        $identitasPengirim = $this->getFormIdentitasXml(array($nasabahPengirim, $nonNasabahPengirim));

        /* ============================ END IDENTITAS PENGIRIM ============================ */




        /* ============================ IDENTITAS PENERIMA ================================= */
        $alamatLengkapKorporasiPenerusPenerima = $this->getFormAlamatXml(array(), 2);
        $korporasiPenerusPenerima = $this->getFormKorporasiXml(array(
            7 => $alamatLengkapKorporasiPenerusPenerima
                ), 2);

        $buktiLainPeroranganPenerusPenerima = $this->getFormBuktiLainXml(array());
        $buktiIdentitasPeroranganPenerusPenerima = $this->getFormBuktiIdentitasXml(
                array(5 => $buktiLainPeroranganPenerusPenerima)
        );
        $alamatSesuaiBuktiIdentitasPenerusPenerima = $this->getFormAlamatXml(array(), 2);
        $alamatDomisiliPenerusPenerima = $this->getFormAlamatXml(array(), 2);
        $kewarganegaraanPenerusPenerima = $this->getFormKewarganegaraanXml(array());
        $peroranganPenerusPenerima = $this->getFormPeroranganXml(array(
            4 => $kewarganegaraanPenerusPenerima,
            7 => $alamatDomisiliPenerusPenerima,
            8 => $alamatSesuaiBuktiIdentitasPenerusPenerima,
            10 => $buktiIdentitasPeroranganPenerusPenerima
                ), 2);

        $buktiLainNonNasabahPenerimaAkhir = $this->getFormBuktiLainXml(array());
        $buktiIdentitasNonNasabahPenerimaAkhir = $this->getFormBuktiIdentitasXml(
                array(5 => $buktiLainNonNasabahPenerimaAkhir)
        );


        $nonNasabahPenerimaAkhir = $this->getFormNonNasabahXml(array(
            4 => $buktiIdentitasNonNasabahPenerimaAkhir
                ), 2);

        $buktiLainPeroranganPenerimaAkhir = $this->getFormBuktiLainXml(array());
        $buktiIdentitasPeroranganPenerimaAkhir = $this->getFormBuktiIdentitasXml(
                array(5 => $buktiLainPeroranganPenerimaAkhir)
        );
        $alamatSesuaiBuktiIdentitasPenerimaAkhir = $this->getFormAlamatXml(array(), 2);
        $alamatDomisiliPenerimaAkhir = $this->getFormAlamatXml(array(), 2);
        $kewarganegaraanPenerimaAkhir = $this->getFormKewarganegaraanXml(array());
        $peroranganPenerimaAkhir = $this->getFormPeroranganXml(array(
            3 => $kewarganegaraanPenerimaAkhir,
            6 => $alamatDomisiliPenerimaAkhir,
            7 => $alamatSesuaiBuktiIdentitasPenerimaAkhir,
            9 => $buktiIdentitasPeroranganPenerimaAkhir
                ), 3);

        $alamatKorporasiPenerimaAkhrir = $this->getFormAlamatXml(array(), 2);
        $korporasiPenerimaAkhir = $this->getFormKorporasiXml(array(
            6 => $alamatKorporasiPenerimaAkhrir
                ), 3);

        $nasabahPenerimaAkhir = $this->getFormIdentitasXml(array(
            $peroranganPenerimaAkhir, $korporasiPenerimaAkhir
                ), 2);

        $penyelenggaraPenerimaAkhir = $this->getFormIdentitasXml(array(
            $nasabahPenerimaAkhir, $nonNasabahPenerimaAkhir
                ), 1);

        $penyelenggaraPenerus = $this->getFormIdentitasXml(array(
            $peroranganPenerusPenerima, $korporasiPenerusPenerima
                ), 2);

        $identitasPenerima = $this->getFormIdentitasXml(array(
            $penyelenggaraPenerimaAkhir, $penyelenggaraPenerus
                ), 3);
        /* ============================ END IDENTITAS PENERIMA ================================= */


        /* ============================ TRANSAKSI ================================= */
        $trxCurrency = $this->getFormCurrencyInstructedAmountXml(array());
        $trxDate = $this->getFormDateCurrencyAmountXml(array());
        $transaksi = $this->getFormTransaksiXml(array(7 => $trxDate, 8 => $trxCurrency));
        /* ============================ END TRANSAKSI ================================= */


        /* ============================ INFO LAINNYA ================================= */
        $infoLainnya = $this->getFormInfoLainXml(array());
        /* ============================ END INFO LAINNYA ================================= */

        $ifti = array(
            'localId' => $param->localId,
            'umum' => $umum,
            'pjkBankSebagai' => $param->pjkBankSebagai,
            'identitasPengirim' => $identitasPengirim,
            'identitasPenerima' => $identitasPenerima,
            'transaksi' => $transaksi,
            'informasiLainnya' => $infoLainnya
        );

        return $ifti;
    }

    public function getFormSwInXml($param) {

        /* ============================ GET MODEL ======================================== */
        $infolains = $param->infolains;
        $nasabahKorporasiDns = $param->nasabahKorporasiDns;
        $nasabahKorporasiLns = $param->nasabahKorporasiLns;
        $nasabahPeroranganDns = $param->nasabahPeroranganDns;
        $nasabahPeroranganLns = $param->nasabahPeroranganLns;
        $nonNasabahDns = $param->nonNasabahDns;
        $nonNasabahLns = $param->nonNasabahLns;
        $transaksis = $param->transaksis;
        /* ============================ END GET MODEL ======================================== */

        /* ============================ UMUM ======================================== */
        $umum = $this->getFormUmumXml(array(
            Yii::app()->util->getKodeStandar(array('modul' => 'tanggal', 'data' => $param->tglLaporan)),
            $param->namaPejabatPjk,
            $param->jenisLaporan,
            $param->pjkBankSebagai
                ));

        /* ============================ END UMUM ====================================== */


        /* ============================ IDENTITAS PENGIRIM ============================ */
        $kewarganegaraanPeroranganPengirim = $this->getFormKewarganegaraanXml(array());
        $alamatSesuaiVoucherPeroranganPengirim = $this->getFormAlamatXml(array());

        $buktiLainPeroranganPengirim = $this->getFormBuktiLainXml(array());
        $buktiIdentitasPeroranganPengirim = $this->getFormBuktiIdentitasXml(array(5 => $buktiLainPeroranganPengirim));

        $peroranganPengirim = $this->getFormPeroranganXml(array(
            3 => $kewarganegaraanPeroranganPengirim,
            4 => $alamatSesuaiVoucherPeroranganPengirim,
            6 => $buktiIdentitasPeroranganPengirim
                ));
        $alamatSesuaiVoucherKorporasiPengirim = $this->getFormAlamatXml(array());

        $korporasiPengirim = $this->getFormKorporasiXml(array(2 => $alamatSesuaiVoucherKorporasiPengirim));

        $alamatSesuaiVoucherNonNasabahPengirim = $this->getFormAlamatXml(array());
        $nonNasabahPengirim = $this->getFormNonNasabahXml(array(4 => $alamatSesuaiVoucherNonNasabahPengirim));
        $nasabahPengirim = $this->getFormIdentitasXml(array($peroranganPengirim, $korporasiPengirim), 1);

        $identitasPengirim = $this->getFormIdentitasXml(array($nasabahPengirim, $nonNasabahPengirim));

        /* ============================ END IDENTITAS PENGIRIM ============================ */




        /* ============================ IDENTITAS PENERIMA ================================= */
        $alamatLengkapKorporasiPenerusPenerima = $this->getFormAlamatXml(array(), 2);
        $korporasiPenerusPenerima = $this->getFormKorporasiXml(array(
            7 => $alamatLengkapKorporasiPenerusPenerima
                ), 2);

        $buktiLainPeroranganPenerusPenerima = $this->getFormBuktiLainXml(array());
        $buktiIdentitasPeroranganPenerusPenerima = $this->getFormBuktiIdentitasXml(
                array(5 => $buktiLainPeroranganPenerusPenerima)
        );
        $alamatSesuaiBuktiIdentitasPenerusPenerima = $this->getFormAlamatXml(array(), 2);
        $alamatDomisiliPenerusPenerima = $this->getFormAlamatXml(array(), 2);
        $kewarganegaraanPenerusPenerima = $this->getFormKewarganegaraanXml(array());
        $peroranganPenerusPenerima = $this->getFormPeroranganXml(array(
            4 => $kewarganegaraanPenerusPenerima,
            7 => $alamatDomisiliPenerusPenerima,
            8 => $alamatSesuaiBuktiIdentitasPenerusPenerima,
            10 => $buktiIdentitasPeroranganPenerusPenerima
                ), 2);

        $buktiLainNonNasabahPenerimaAkhir = $this->getFormBuktiLainXml(array());
        $buktiIdentitasNonNasabahPenerimaAkhir = $this->getFormBuktiIdentitasXml(
                array(5 => $buktiLainNonNasabahPenerimaAkhir)
        );


        $nonNasabahPenerimaAkhir = $this->getFormNonNasabahXml(array(
            4 => $buktiIdentitasNonNasabahPenerimaAkhir
                ), 2);

        $buktiLainPeroranganPenerimaAkhir = $this->getFormBuktiLainXml(array());
        $buktiIdentitasPeroranganPenerimaAkhir = $this->getFormBuktiIdentitasXml(
                array(5 => $buktiLainPeroranganPenerimaAkhir)
        );
        $alamatSesuaiBuktiIdentitasPenerimaAkhir = $this->getFormAlamatXml(array(), 2);
        $alamatDomisiliPenerimaAkhir = $this->getFormAlamatXml(array(), 2);
        $kewarganegaraanPenerimaAkhir = $this->getFormKewarganegaraanXml(array());
        $peroranganPenerimaAkhir = $this->getFormPeroranganXml(array(
            3 => $kewarganegaraanPenerimaAkhir,
            6 => $alamatDomisiliPenerimaAkhir,
            7 => $alamatSesuaiBuktiIdentitasPenerimaAkhir,
            9 => $buktiIdentitasPeroranganPenerimaAkhir
                ), 3);

        $alamatKorporasiPenerimaAkhrir = $this->getFormAlamatXml(array(), 2);
        $korporasiPenerimaAkhir = $this->getFormKorporasiXml(array(
            6 => $alamatKorporasiPenerimaAkhrir
                ), 3);

        $nasabahPenerimaAkhir = $this->getFormIdentitasXml(array(
            $peroranganPenerimaAkhir, $korporasiPenerimaAkhir
                ), 2);

        $penyelenggaraPenerimaAkhir = $this->getFormIdentitasXml(array(
            $nasabahPenerimaAkhir, $nonNasabahPenerimaAkhir
                ), 1);

        $penyelenggaraPenerus = $this->getFormIdentitasXml(array(
            $peroranganPenerusPenerima, $korporasiPenerusPenerima
                ), 2);

        $identitasPenerima = $this->getFormIdentitasXml(array(
            $penyelenggaraPenerimaAkhir, $penyelenggaraPenerus
                ), 3);
        /* ============================ END IDENTITAS PENERIMA ================================= */


        /* ============================ TRANSAKSI ================================= */
        $trxCurrency = $this->getFormCurrencyInstructedAmountXml(array(
            $this->getValue($transaksis, 'idCurrencyInstructedAmount'),
            $this->getValue($transaksis, 'currencyLain'),
            $this->getValue($transaksis, 'instructedAmount')
                ));
        $trxDate = $this->getFormDateCurrencyAmountXml(array(
            $this->getValue($transaksis, 'valueDate'),
            $this->getValue($transaksis, 'amount'),
            $this->getValue($transaksis, 'idCurrency'),
            $this->getValue($transaksis, 'currencyLain'),
            $this->getValue($transaksis, 'amountDalamRupiah'),
                ));
        $transaksi = $this->getFormTransaksiXml(array(
            $this->getValue($transaksis, 'tglTransaksi'),
            $this->getValue($transaksis, 'timeIndication'),
            $this->getValue($transaksis, 'sendersReference'),
            $this->getValue($transaksis, 'bankOperationCode'),
            $this->getValue($transaksis, 'instructionCode'),
            $this->getValue($transaksis, 'kanCabPenyelenggaraPengirimAsal'),
            $this->getValue($transaksis, 'typeTransactionCode'),
            $trxDate,
            $trxCurrency,
            $this->getValue($transaksis, 'exchangeRate'),
            $this->getValue($transaksis, 'sendingInstitution'),
            $this->getValue($transaksis, 'tujuanTransaksi'),
            $this->getValue($transaksis, 'sumberDana')
                ));
        /* ============================ END TRANSAKSI ================================= */


        /* ============================ INFO LAINNYA ================================= */
        $infoLainnya = $this->getFormInfoLainXml(array(
            $this->getValue($infolains, 'infSendersCorrespondent'),
            $this->getValue($infolains, 'infReceiverCorrespondent'),
            $this->getValue($infolains, 'infThirdReimbursementInstitution'),
            $this->getValue($infolains, 'infIntermediaryInstitution'),
            $this->getValue($infolains, 'remittanceInformation'),
            $this->getValue($infolains, 'senderToReceiverInformation'),
            $this->getValue($infolains, 'regulatoryReporting'),
            $this->getValue($infolains, 'envelopeContents')
                ));
        /* ============================ END INFO LAINNYA ================================= */

        $ifti = array(
            'localId' => $param->localId,
            'umum' => $umum,
            'pjkBankSebagai' => $param->pjkBankSebagai,
            'identitasPengirim' => $identitasPengirim,
            'identitasPenerima' => $identitasPenerima,
            'transaksi' => $transaksi,
            'informasiLainnya' => $infoLainnya
        );

        return $ifti;
    }

    public function getFormInfoLainXml($param) {
        $tmp = array(
            'infSendersCorrespondent',
            'infReceiverCorrespondent',
            'infThirdReimbursementInstitution',
            'infIntermediaryInstitution',
            'remittanceInformation',
            'senderToReceiverInformation',
            'regulatoryReporting',
            'envelopeContents'
        );
        $data = $this->setArray($tmp, $param);
        return $data;
    }

    public function getFormCurrencyInstructedAmountXml($param) {
        $tmp = array(
            'currency',
            'currencyLain',
            'instructedAmount'
        );
        $data = $this->setArray($tmp, $param);
        return $data;
    }

    public function getFormDateCurrencyAmountXml($param) {
        $tmp = array(
            'valueDate',
            'amount',
            'currency',
            'currencyLain',
            'amountDalamRupiah'
        );
        $data = $this->setArray($tmp, $param);
        return $data;
    }

    public function getFormTransaksiXml($param) {
        $tmp = array(
            'tglTransaksi',
            'timeIndication',
            'sendersReference',
            'bankOperationCode',
            'instructionCode',
            'kanCabPenyelenggaraPengirimAsal',
            'typeTransactionCode',
            'dateCurrencyAmount',
            'currencyInstructedAmount',
            'exchangeRate',
            'sendingInstitution',
            'tujuanTransaksi',
            'sumberDana'
        );
        $data = $this->setArray($tmp, $param);
        return $data;
    }

    public function getFormIdentitasXml($param, $type = null) {
        $type = ($type == null) ? 1 : $type;
        switch ($type) {
            case 1:
                $tmp = array(
                    'nasabah',
                    'nonNasabah'
                );
                break;
            case 2:
                $tmp = array(
                    'perorangan',
                    'korporasi'
                );
                break;
            case 3:
                $tmp = array(
                    'penyelenggaraPenerimaAkhir',
                    'penyelenggaraPenerus'
                );
                break;
            default:
                $tmp = array(
                    'nasabah',
                    'nonNasabah'
                );
                break;
        }
        $data = $this->setArray($tmp, $param);
        return $data;
    }

    public function getFormAlamatXml($param, $type = null) {
        $type = ($type == null) ? 1 : $type;
        switch ($type) {
            case 1:
                $tmp = array(
                    'alamat',
                    'negaraBagianKota',
                    'idNegara',
                    'negaraLain'
                );
                break;
            case 2:
                $tmp = array(
                    'alamat',
                    'idPropinsi',
                    'propinsiLain',
                    'idKabKota',
                    'kabKotaLain'
                );
                break;

            default:
                $tmp = array(
                    'alamat',
                    'negaraBagianKota',
                    'idNegara',
                    'negaraLain'
                );
                break;
        }
        $data = $this->setArray($tmp, $param);
        return $data;
    }

    public function getFormNonNasabahXml($param, $type = null) {
        $type = ($type == null) ? 1 : $type;
        switch ($type) {
            case 1:
                $tmp = array(
                    'noRekening',
                    'namaBank',
                    'namaLengkap',
                    'tglLahir',
                    'alamatSesuaiVoucher',
                    'noTelp'
                );
                break;
            case 2:
                $tmp = array(
                    'namaLengkap',
                    'tglLahir',
                    'alamat',
                    'noTelp',
                    'buktiIdentitas',
                    'nilaiTransaksiDalamRupiah'
                );
                break;

            default:
                $tmp = array(
                    'noRekening',
                    'namaBank',
                    'namaLengkap',
                    'tglLahir',
                    'alamatSesuaiVoucher',
                    'noTelp'
                );
                break;
        }


        $data = $this->setArray($tmp, $param);
        return $data;
    }

    public function getFormKorporasiXml($param, $type = null) {
        $type = ($type == null) ? 1 : $type;
        switch ($type) {
            case 1:
                $tmp = array(
                    'noRekening',
                    'namaKorporasi',
                    'alamatSesuaiVoucher',
                    'noTelp'
                );
                break;
            case 2:
                $tmp = array(
                    'noRekening',
                    'namaBank',
                    'namaKorporasi',
                    'bentukBadan',
                    'bentukBadanLain',
                    'bidangUsaha',
                    'bidangUsahaLain',
                    'alamatLengkapKorporasi',
                    'noTelp',
                    'nilaiTransaksiDalamRupiah'
                );
                break;
            case 3:
                $tmp = array(
                    'noRekening',
                    'namaKorporasi',
                    'bentukBadan',
                    'bentukBadanLain',
                    'bidangUsaha',
                    'bidangUsahaLain',
                    'alamatLengkapKorporasi',
                    'noTelp',
                    'nilaiTransaksiDalamRupiah'
                );
                break;

            default:
                $tmp = array(
                    'noRekening',
                    'namaKorporasi',
                    'alamatSesuaiVoucher',
                    'noTelp'
                );
                break;
        }

        $data = $this->setArray($tmp, $param);
        return $data;
    }

    public function getFormPeroranganXml($param, $type = null) {
        $type = ($type == null) ? 1 : $type;
        switch ($type) {
            case 1:
                $tmp = array(
                    'noRekening',
                    'namaLengkap',
                    'tglLahir',
                    'kewarganegaraan',
                    'alamatSesuaiVoucher',
                    'noTelp',
                    'buktiIdentitas'
                );
                break;
            case 2:
                $tmp = array(
                    'noRekening',
                    'namaBank',
                    'namaLengkap',
                    'tglLahir',
                    'kewarganegaraan',
                    'pekerjaan',
                    'pekerjaanLain',
                    'alamatDomisili',
                    'alamatSesuaiBuktiIdentitas',
                    'noTelp',
                    'buktiIdentitas',
                    'nilaiTransaksiDalamRupiah'
                );
                break;
            case 3:
                $tmp = array(
                    'noRekening',
                    'namaLengkap',
                    'tglLahir',
                    'kewarganegaraan',
                    'pekerjaan',
                    'pekerjaanLain',
                    'alamatDomisili',
                    'alamatSesuaiBuktiIdentitas',
                    'noTelp',
                    'buktiIdentitas',
                    'nilaiTransaksiDalamRupiah'
                );
                break;

            default:
                $tmp = array(
                    'noRekening',
                    'namaLengkap',
                    'tglLahir',
                    'kewarganegaraan',
                    'alamatSesuaiVoucher',
                    'noTelp',
                    'buktiIdentitas'
                );
                break;
        }

        $data = $this->setArray($tmp, $param);
        return $data;
    }

    public function getFormBuktiIdentitasXml($param) {
        $tmp = array(
            'ktp',
            'sim',
            'passport',
            'kimsKitasKitap',
            'npwp',
            'buktiLain'
        );
        $data = $this->setArray($tmp, $param);
        return $data;
    }

    public function getFormBuktiLainXml($param) {
        $tmp = array(
            'jenisBuktiLain',
            'noBuktiLain'
        );
        $data = $this->setArray($tmp, $param);
        return $data;
    }

    public function getFormKewarganegaraanXml($param) {
        $tmp = array(
            'wargaNegara',
            'idNegara',
            'negaraLain'
        );
        $data = $this->setArray($tmp, $param);
        return $data;
    }

    public function getFormUmumXml($param) {
        $tmp = array(
            'tglLaporan',
            'namaPejabatPjk',
            'jenisLaporan',
            'noLtklKoreksi'
        );
        $data = $this->setArray($tmp, $param);
        return $data;
    }

    public function getValue($param, $field) {
        $data = ($param && count($param) > 1) ? $param->{$field} : '';
        return $data;
    }

    public function setArray($a, $b) {
        $data = array();
        foreach ($a as $key => $value) {
            $data[$value] = (key_exists($key, $b)) ? $b[$key] : '';
        }
        return $data;
    }

    public function genSwiftXml($param, $xml = null, $root = null, $type = null) {
        if ($xml == null) {
            $xml = new DOMDocument('1.0', 'UTF-8');
            $xml->formatOutput = true;
            $root = $xml->createElementNS('http://www.w3.org/2005/Atom', $root);
            $xml->appendChild($root);
            $root->setAttribute("type", $type);
            $root->setAttributeNS('http://www.w3.org/2001/XMLSchema-instance', "xsi:noNamespaceSchemaLocation", 'Ifti' . $type . '.xsd');
        }
        foreach ($param as $k => $v) {
            if (is_array($v)) {
                $tmp = $xml->createElement($k);
                $nodeTmp = $root->appendChild($tmp);
                self::genSwiftXml($v, $xml, $nodeTmp);
            } else {
                $root->appendChild($xml->createElement($k, $v));
            }
        }
        return $xml->saveXML();
    }

    public function ahdaGridForm($data, $pages, $actions, $data_grid, $sort) {
        $str = '<div class="col-md-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped list">
                            <thead>
                                <tr>';
        if ($data) {
            $admin = Yii::app()->user->getState('admin');
            $frist = current($data);
            $labels = $frist->attributeLabels();

            $str .=' <th class="list-number">#</th>';
            foreach ($data_grid as $value) {
                if (is_array($value)) {
                    $exp = explode('&', $value['relasi']);
                    $str.= '<th>' . $sort->link($exp[0], '<i class="icon-sort sortIcon pull-right"></i> ' . $labels[$exp[0]]) . '</th>';
                } else {
                    $str.= '<th>' . $sort->link($value, '<i class="icon-sort sortIcon pull-right"></i> ' . $labels[$value]) . '</th>';
                }
            }
            $str .= '<th class="list-actions">Actions</th></tr></thead><tbody>';
            $currentPage = $pages->currentPage + 1;
            $i = ($currentPage - 1) * $pages->pageSize;
            foreach ($data as $d) {
                $i++;
                $str .= '<tr><td class="list-number">' . $i . '</td>';
                foreach ($data_grid as $value) {
                    if (is_array($value)) {
                        $exp = explode('&', $value['relasi']);
                        $field = $exp[0];
                        $relasi = $exp[1];
                        $modul = explode('[', $relasi);
                        if (is_array($modul) && count($modul) > 1) {
                            if ($d->{$field}) {
                                $modul = str_replace(']', '', $modul[1]);
                                $data_modul = Yii::app()->util->getKodeStandar(array('modul' => $modul, 'data' => $d->{$field}));
                                $str .= '<td>' . $this->purify($data_modul) . '</td>';
                            } else {
                                $str .= '<td></td>';
                            }
                        } else {
                            if ($d->{$relasi}) {
                                $str .= '<td>' . $this->purify($d->{$relasi}->{$value['field']}) . '</td>';
                            } else {
                                $str .= '<td></td>';
                            }
                        }
                    } else {
                        $str .= '<td>' . $this->purify($d->{$value}) . '</td>';
                    }
                }
                $str .= '<td class="list-actions customList">';
                if (key_exists('edit', $actions)) {
                    if ($admin->hasPermissions($actions['edit']['permission'])) {
                        $url_edit = Yii::app()->baseUrl . '/' . Yii::app()->controller->module->id . '/' . $actions['edit']['url'];
                        $icon = key_exists('icon', $actions['edit']) ? $actions['edit']['icon'] : 'pencil';
                        $str .= ' <a href="' . $url_edit . $d->id . '" class="btn btn-xs btn-default bootip" title="Update"><span class="icon icon-' . $icon . '"></span></a>';
                    }
                }
                if (key_exists('delete', $actions)) {
                    if ($admin->hasPermissions($actions['delete']['permission'])) {
                        $url_delete = Yii::app()->baseUrl . '/' . Yii::app()->controller->module->id . '/' . $actions['delete']['url'];
                        $icon = key_exists('icon', $actions['delete']) ? $actions['delete']['icon'] : 'trash';
                        $str .= '<a href="' . $url_delete . $d->id . '" class="btn btn-xs btn-default btn-delete bootip" title="Delete" data-confirm="Are you sure want to delete this record?"><span class="icon icon-' . $icon . '"></span></a>';
                    }
                }
                $str .='</td></tr>';
            }
        } else {
            $str .= '<tr><td colspan="8"><div class="alert alert-warning">No record found.</div></td></tr>';
        }
        $str .= '</tbody></table> </div></div>';
        return $str;
    }

    public function ahdaGrid($model_name, $filters) {
        $criteria = new CDbCriteria;
        if (isset($_GET['Filter'])) {
            $filters_x = $_GET['Filter'];
            foreach ($filters as $key => $value) {
                if ($filters_x[$key]) {
                    if (substr_count($key, '|')) {
                        $exp = explode('|', $key);
                        $key = current($exp);
                        $criteria->addInCondition($key, array($key => $value));
                    } else {
                        $criteria->addSearchCondition($key, $value);
                    }
                }
            }
        }

        $dataCount = $model_name::model()->count($criteria);

        $pages = new CPagination($dataCount);
        $pages->setPageSize(Yii::app()->setting->get('list_size'));
        $pages->applyLimit($criteria);

        $sort = new CSort;
        $sort->modelClass = $model_name;
        $sort->attributes = array('*');
        $sort->defaultOrder = 'id DESC';
        $sort->applyOrder($criteria);

        $data = $model_name::model()->findAll($criteria);

        return array('data' => $data, 'pages' => $pages, 'sort' => $sort);
    }

    public function ahdaFilterGridForm($filters, $class = null) {
        $str = '<div class="panel panel-default panel-backend">
                <div class="panel-heading"><span class="glyphicon glyphicon-filter"></span> Filter</div>
                <div class="panel-body">
                <form method="get" class="form-filter">';
        foreach ($filters as $key => $value) {
            $str .= '<div class="form-group">';
            if (substr_count($key, '|')) {
                $exp = explode('|', $key);
                $modul = $exp[1];
                $str .= Yii::app()->util->getKodeStandar(array('modul' => $modul, 'data' => array('name' => 'Filter[' . $key . ']', 'value' => $value, 'class' => ($class != null) ? $class : null)));
            } else {
                $str .= '<input class="form-control" type="text" name="Filter[' . $key . ']" placeholder="' . ucfirst($key) . ' contains ..." value="' . $value . '">';
            }
            $str .= '</div>';
        }
        $str .= '<hr>
                 <button class="btn btn-danger btn-lg btn-block"><span class="icon icon-filter"></span> Filter</button>
                 </form>
                 </div>
                 </div>';
        return $str;
    }

    public function ahdaSortGridForm($sort, $data) {
        $name_sort = $sort->directions;
        $nameSort = key($name_sort);
        $option = '';
        foreach ($data as $value) {
            $option .= '<li>' . $sort->link($value) . '</li>';
        }
        $str = '<div class="panel panel-default panel-backend">
                        <div class="panel-heading"><span class="glyphicon glyphicon-list"></span> Sortir</div>
                        <div class="panel-body">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default sortLimit">Sort By ' . ucwords($nameSort) . '</button>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">';
        $str .= $option;
        $str .= '</ul></div></div></div>';

        return $str;
    }

    public function ahdaPagesGridForm($url, $pages, $filters) {
        $currentPage = $pages->currentPage + 1;
        $url = Yii::app()->baseUrl . '/' . Yii::app()->controller->module->id . '/' . $url;
        $str = '';
        if ($pages->pageCount > 1) {
            $qs = array();
            foreach ($filters as $k => $v) {
                $qs[] = 'Filter[' . $k . ']=' . $v;
            }
            $qs = implode('&', $qs);
            $str .= '<div class="row paginator"><form method="get"><div class="col-md-4 col-sm-4 col-xs-4">';
            $disabled = 'disabled';
            $goto = $currentPage - 1;
            if ($currentPage > 1)
                $disabled = '';
            $str .= '<a href=' . $url . '?page=' . $goto . '&' . $qs . ' class="btn btn-warning btn-sm btn-block ' . $disabled . ' bootip" title="Previous page"><span class="icon icon-chevron-left"></span></a></div>
                     <div class="col-md-4 col-sm-4 col-xs-4 input">
                     <input type="text" class="form-control input-sm" name="page" value="' . $currentPage . '">
                     </div><div class="col-md-4 col-sm-4 col-xs-4">';
            $disabled = 'disabled';
            $goto = $currentPage + 1;
            if ($currentPage < $pages->pageCount)
                $disabled = '';
            $str .= '<a href=' . $url . '?page=' . $goto . '&' . $qs . ' class="btn btn-warning btn-sm btn-block ' . $disabled . ' bootip" title="Next page"><span class="icon icon-chevron-right"></span></a></div></form></div>';
        }
        $summary = $this->ahdaSummaryPagesGridForm($pages, $currentPage);
        return $str . $summary;
    }

    public function ahdaSummaryPagesGridForm($pages, $currentPage) {
        $str = '<div class="panel panel-default panel-backend">
                <div class="panel-heading"><span class="glyphicon glyphicon-flag"></span> Summary</div>
                <div class="panel-body">';
        $str .= $pages->itemCount . ' record(s) found.<br>Showing page ' . $currentPage . ' of ' . $pages->pageCount;
        $str .= '</div></div>';

        return $str;
    }

    public function ahdaCreateGridForm($permission, $url, $label = 'Buat baru') {
        $admin = Yii::app()->user->getState('admin');
        if ($admin->hasPermissions($permission)) {
            $url = Yii::app()->baseUrl . '/' . Yii::app()->controller->module->id . '/' . $url;
            return $str = '<a href="' . $url . '" class="btn btn-primary btn-lg btn-block"><span class="icon icon-plus"></span> ' . $label . '</a>';
        }
    }

    public function ahdaTitleGridForm($param) {
        $str = '';
        if (is_array($param)) {
            $str .= '<h1 class="page-title"><span class="icon-' . $param['icon'] . '"></span> ' . $param['label'] . '</h1>';
        }
        return $str;
    }

    public function ahdaBreadcrumbGridForm($param) {
        $url = Yii::app()->baseUrl . '/' . Yii::app()->controller->module->id . '/';
        $str = '<ol class="breadcrumb">';
        $str .= '<li><a href="' . $url . '">Dashboard</a></li>';
        foreach ($param as $value) {
            $str .= ($value['url']) ? '<li><a href="' . $url . $value['url'] . '">' . $value['label'] . '</a></li>' : '<li class="active">' . $value['label'] . '</li>';
        }

        $str .= '</ol>';

        return $str;
    }

    public function getPenerima($swiftId, $param) {
        $swift = Swift::model()->findByPk($swiftId);

        $jenisSwift = $swift->jenisSwift;

        switch ($jenisSwift) {
            case ($jenisSwift == 1 || $jenisSwift == 3):
                $nasabahPeroranganDn = $swift->nasabahPeroranganDns;
                $nasabahKorporasiDn = $swift->nasabahKorporasiDns;
                $nonNasabahDn = $swift->nonNasabahDns;

                if (count($nasabahPeroranganDn) > 0) {
                    $nasabahPeroranganDn = current($nasabahPeroranganDn);
                    if ($param === 'all'){
                        $data = array(
                            'key' => 1,
                            'data' =>$nasabahPeroranganDn
                            );
                        return $data;
                    }
                    else
                        return $nasabahPeroranganDn->{$param};
                }
                
                if (count($nasabahKorporasiDn) > 0) {
                    $nasabahKorporasiDn = current($nasabahKorporasiDn);
                    if ($param === 'all'){
                        $data = array(
                            'key' => 2,
                            'data' =>$nasabahKorporasiDn
                            );
                        return $data;
                    }
                    else
                        return $nasabahKorporasiDn->namaKorporasi;
                }
                
                if (count($nonNasabahDn) > 0) {
                    $nonNasabahDn = current($nonNasabahDn);
                    if ($param === 'all'){
                        $data = array(
                            'key' => 3,
                            'data' =>$nonNasabahDn
                            );
                        return $data;
                    }
                    else
                        return $nonNasabahDn->{$param};
                }

                break;
                
                
            case ($jenisSwift == 2 || $jenisSwift == 4):
                $nasabahPeroranganLn = $swift->nasabahPeroranganLns;
                $nasabahKorporasiLn = $swift->nasabahKorporasiLns;
                $nonNasabahLn = $swift->nonNasabahLns;

                if (count($nasabahPeroranganLn) > 0) {
                    $nasabahPeroranganLn = current($nasabahPeroranganLn);
                    if ($param === 'all'){
                        $data = array(
                            'key' => 1,
                            'data' =>$nasabahPeroranganLn
                            );
                        return $data;
                    }
                    else
                        return $nasabahPeroranganLn->{$param};
                }
                
                if (count($nasabahKorporasiLn) > 0) {
                    $nasabahKorporasiLn = current($nasabahKorporasiLn);
                    if ($param === 'all'){
                        $data = array(
                            'key' => 2,
                            'data' =>$nasabahKorporasiLn
                            );
                        return $data;
                    }
                    else
                        return $nasabahKorporasiLn->namaKorporasi;
                }
                
                if (count($nonNasabahLn) > 0) {
                    $nonNasabahLn = current($nonNasabahLn);
                    if ($param === 'all'){
                        $data = array(
                            'key' => 3,
                            'data' =>$nonNasabahLn
                            );
                        return $data;
                    }
                    else
                        return $nonNasabahLn->{$param};
                }

                break;

            default:
                break;
        }
    }
    
    public function getPengirim($swiftId, $param) {
        $swift = Swift::model()->findByPk($swiftId);

        $jenisSwift = $swift->jenisSwift;

        switch ($jenisSwift) {
            case ($jenisSwift == 2 || $jenisSwift == 4):
                $nasabahPeroranganDn = $swift->nasabahPeroranganDns;
                $nasabahKorporasiDn = $swift->nasabahKorporasiDns;
                $nonNasabahDn = $swift->nonNasabahDns;

                if (count($nasabahPeroranganDn) > 0) {
                    $nasabahPeroranganDn = current($nasabahPeroranganDn);
                    if ($param === 'all'){
                        $data = array(
                            'key' => 1,
                            'data' =>$nasabahPeroranganDn
                            );
                        return $data;
                    }
                    else
                        return $nasabahPeroranganDn->{$param};
                }
                
                if (count($nasabahKorporasiDn) > 0) {
                    $nasabahKorporasiDn = current($nasabahKorporasiDn);
                    if ($param === 'all'){
                        $data = array(
                            'key' => 2,
                            'data' =>$nasabahKorporasiDn
                            );
                        return $data;
                    }
                    else
                        return $nasabahKorporasiDn->namaKorporasi;
                }
                
                if (count($nonNasabahDn) > 0) {
                    $nonNasabahDn = current($nonNasabahDn);
                    if ($param === 'all'){
                        $data = array(
                            'key' => 3,
                            'data' =>$nonNasabahDn
                            );
                        return $data;
                    }
                    else
                        return $nonNasabahDn->{$param};
                }

                break;
                
                
            case ($jenisSwift == 1 || $jenisSwift == 3):
                $nasabahPeroranganLn = $swift->nasabahPeroranganLns;
                $nasabahKorporasiLn = $swift->nasabahKorporasiLns;
                $nonNasabahLn = $swift->nonNasabahLns;

                if (count($nasabahPeroranganLn) > 0) {
                    $nasabahPeroranganLn = current($nasabahPeroranganLn);
                    if ($param === 'all'){
                        $data = array(
                            'key' => 1,
                            'data' =>$nasabahPeroranganLn
                            );
                        return $data;
                    }
                    else
                        return $nasabahPeroranganLn->{$param};
                }
                
                if (count($nasabahKorporasiLn) > 0) {
                    $nasabahKorporasiLn = current($nasabahKorporasiLn);
                    if ($param === 'all'){
                        $data = array(
                            'key' => 2,
                            'data' =>$nasabahKorporasiLn
                            );
                        return $data;
                    }
                    else
                        return $nasabahKorporasiLn->namaKorporasi;
                }
                
                if (count($nonNasabahLn) > 0) {
                    $nonNasabahLn = current($nonNasabahLn);
                    if ($param === 'all'){
                        $data = array(
                            'key' => 3,
                            'data' =>$nonNasabahLn
                            );
                        return $data;
                    }
                    else
                        return $nonNasabahLn->{$param};
                }

                break;

            default:
                break;
        }
    }
    

}