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

    public function getKodeStandar($param) {
        if ($param['modul'] === 'tanggal') {
            return date('d-m-Y', strtotime($param['data']));
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
//            $criteria = new CDbCriteria;
//            $criteria->order = 'nama ASC';
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
                'pjkBankSebagai' => array(1 => 'Penyelenggara Penerima Akhir', 2 => 'Penyelenggara Penerus'),
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
                'upload' => array('cus' => 'Customer', 'trx' => 'Transaksi')
            );
            $data = $modul[$param['modul']];
        }

        if ($param['data'] === 'all')
            return $data;
        elseif ($param['data'] === 'all&blank')
            return $this->buildDropDown($data);
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

    /**
     * Converts an array to Xml
     *
     * @param mixed $arData The array to convert
     * @param mixed $sRootNodeName The name of the root node in the returned Xml
     * @param string $sXml The converted Xml
     */
    public function arrayToXml($arData, $sRootNodeName = 'data', $sXml = null) {
        // turn off compatibility mode as simple xml doesn't like it
        if (1 == ini_get('zend.ze1_compatibility_mode'))
            ini_set('zend.ze1_compatibility_mode', 0);

        if (null == $sXml)
            $sXml = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><{$sRootNodeName} />");

        // loop through the data passed in.
        foreach ($arData as $_sKey => $_oValue) {
            // no numeric keys in our xml please!
            if (is_numeric($_sKey))
                $_sKey = "unknownNode_" . (string) $_sKey;

            // replace anything not alpha numeric
            $_sKey = preg_replace('/[^a-z]/i', '', $_sKey);

            // if there is another array found recrusively call this function
            if (is_array($_oValue)) {
                $_oNode = $sXml->addChild($_sKey);
                self::arrayToXml($_oValue, $sRootNodeName, $_oNode);
            } else {
                // add single node.
                $_oValue = htmlentities($_oValue);
                $sXml->addChild($_sKey, $_oValue);
            }
        }

        return( $sXml->asXML() );
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

    public function actionCreatefile($filename, $filelist) {
        $zip = new ZipArchive();
        $destination = 'download/' . $filename;
        if ($zip->open($destination, ZIPARCHIVE::CREATE) !== true) {
            return false;
        }

        foreach ($filelist as $file) {
            if (file_exists($file)) {
                $zip->addFile($file);
            }
        }
        $zip->close();
        foreach ($filelist as $file) {
            unlink($file);
        }

        if (file_exists($destination)) {
            header('Content-type: application/zip');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            readfile($destination);
            // remove zip file is exists in temp path
            unlink($destination);
        }
    }

    public function createZip($file_name, $filezip = array()) {
        $filename = Yii::app()->params['tmp'] . $file_name;
        if (file_exists($filename)) {
            unlink($filename);
        }
        $zip = new ZipArchive();

        if ($zip->open($filename, ZipArchive::CREATE) !== TRUE) {
            throw new CHttpException(500, 'cannot open <$filename>\n');
        } else {
            foreach ($filezip as $filesrc) {
                $new = explode('/', $filesrc);
                $zip->addFile($filesrc, end($new));
            }
            $zip->close();
        }
    }

    public function actionZip() {
        $filename = time() . '.zip';
        if (isset($_POST['pics'])) {
            $this->createZip($filename, $_POST['pics']);

            if (file_exists(Yii::app()->params['tmp'] . $filename)) {
                // push to download the zip
                header('Content-type: application/zip');
                header('Content-Disposition: attachment; filename="' . $filename . '"');
                readfile(Yii::app()->params['tmp'] . $filename);
                // remove zip file is exists in temp path
                unlink(Yii::app()->params['tmp'] . $filename);
            }
        }
    }

}