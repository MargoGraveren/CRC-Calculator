<?php
namespace App;
include 'crcstructs.php';
include 'crc16/crc_16_arc.php';
include 'crc16/crc_16_ccitt_false.php';

class Crc16 {

    public function ComputeCrc($crcParams, $data) {
        if ($crcParams->RefIn) {
            $crc = $crcParams->InvertedInit;
        } else {
            $crc = $crcParams->Init;
        }
        if ($crcParams->RefOut) {
            foreach ($data as $d) {
                $crc = $crcParams->Array[($d ^ $crc) & 0xFF] ^ ($crc >> 8 & 0xFF);
            }
        } else {
            foreach ($data as $d) {
                $crc = $crcParams->Array[(($crc >> 8) ^ $d) & 0xFF] ^ ($crc << 8);
            }
        }

        $crc = $crc ^ $crcParams->XorOut;

        $result = new CrcResult();
        $result->Crc = $crc & 0xFFFF;

        return $result;
    }
}

$crcList = array(
    $CRC_16_CCITT_FALSE_,
    $CRC_16_ARC_,
);

