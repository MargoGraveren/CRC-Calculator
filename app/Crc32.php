<?php

include_once 'crcstructs.php';

class Crc32 {

    public function ComputeCrc($crcParams, $data) {
        $crc = $crcParams->Init;

        if ($crcParams->RefOut) {
            foreach ($data as $d) {
                $crc = $crcParams->Array[($d ^ $crc) & 0xFF] ^ ($crc >> 8 & 0xFFFFFF);
            }
        } else {
            foreach ($data as $d) {
                $crc = $crcParams->Array[(($crc >> 24) ^ $d) & 0xFF] ^ ($crc << 8);
            }
        }

        $crc = $crc ^ $crcParams->XorOut;

        $result = new CrcResult();
        $result->Crc = $crc;

        return $result;
    }

}

include_once './crc32/CRC_32.php';

$crcList = array(
    $CRC_32_,
);
