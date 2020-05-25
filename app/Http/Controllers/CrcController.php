<?php

namespace App\Http\Controllers;

use App\Crc16ARC;
use App\Crc16CCITT;
use App\Hamming;
use Illuminate\Http\Request;


class CrcController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        $valueToConvert = $request->input('valueToConvert');
        $valueOfFirstIncorrectByte = $request->input('error1');
        $valueOfSecondIncorrectByte = $request->input('error2');
        $valueOfThirdIncorrectByte = $request->input('error3');
        $valueOfFourthIncorrectByte = $request->input('error4');
        $crcButtonId = $request->input('crcButton');
        $valueInBinary = $this->asc2bin($valueToConvert);
        $valueInBinaryAndCrc = '';

        $crcValue = self::getCrcValue($request, $valueToConvert); //kod CRC
        $crcSize = self::getCrcSize($request); //długość CRC

        //uzupełnianie 0 w zależności od długości CRC
        if($crcSize == 16){
            $valueInBinaryAndCrc = $valueInBinary . sprintf("%016d", decbin($crcValue));
        } else if ($crcSize == 32){
            $valueInBinaryAndCrc = $valueInBinary . str_pad(decbin($crcValue), 32, 0, STR_PAD_LEFT);
        }

        $hammingValue = Hamming::encodeHamming($valueInBinaryAndCrc); //string z bitami hamminga
        $incorrectHammingValue = $hammingValue; //kopia stringu z bitami hamminga żeby można było porównać po przekłamaniach
        if($valueOfFirstIncorrectByte == null && $valueOfSecondIncorrectByte == null &&
            $valueOfThirdIncorrectByte == null && $valueOfFourthIncorrectByte == null){
            $errors = [-5, -5, -5, -5];
        }
        elseif ($valueOfSecondIncorrectByte == null && $valueOfThirdIncorrectByte == null
            && $valueOfFourthIncorrectByte == null){
            $errors = [$valueOfFirstIncorrectByte];
        }
        elseif ($valueOfThirdIncorrectByte == null && $valueOfFourthIncorrectByte == null){
            $errors = [$valueOfFirstIncorrectByte, $valueOfSecondIncorrectByte];
        }
        elseif ($valueOfFourthIncorrectByte == null){
            $errors = [$valueOfFirstIncorrectByte, $valueOfSecondIncorrectByte, $valueOfThirdIncorrectByte];
        }
        else
            $errors = [$valueOfFirstIncorrectByte, $valueOfSecondIncorrectByte, $valueOfThirdIncorrectByte,
            $valueOfFourthIncorrectByte];

        if($errors != null){
            $incorrectHammingValue = Hamming::enterErrors($errors, $incorrectHammingValue); //przekłamany string z hammingiem
            $fixedHammingValue = Hamming::fixHamming($hammingValue, $incorrectHammingValue); //string z poprawką hamminga
            $removedHammingValue = Hamming::removeHammingBits($fixedHammingValue); //string bez bitów hamminga
            $resultValue = $this->bin2ascii(substr($removedHammingValue, 0,  -$crcSize)); //string wynikowy
            $checkCrcValue = self::getCrcValue($request, $resultValue); //CRC obliczone dla stringu wynikowego
        }
        else{
            $incorrectHammingValue = 0;
            $fixedHammingValue = 0;
            $removedHammingValue = Hamming::removeHammingBits($hammingValue); //string bez bitów hamminga
            $resultValue = $this->bin2ascii(substr($removedHammingValue, 0,  -$crcSize)); //string wynikowy
            $checkCrcValue = self::getCrcValue($request, $resultValue); //CRC obliczone dla stringu wynikowego
        }

        return view('crc')
            ->with('valueToConvert', $valueToConvert)
            ->with('valueInBinary', $valueInBinary)
            ->with('crcButtonId', $crcButtonId)
            ->with('crcValue', Hamming::colorCRCOnly($crcValue, $crcSize))
            ->with('valueInBinaryAndCrc', Hamming::colorString($valueInBinaryAndCrc, [], $crcSize, false, false, false))
//            ->with('valueInBinaryAndCrc', Hamming::colorCRC($valueInBinaryAndCrc, $crcSize))
//            ->with('hammingValue', Hamming::colorCRC(Hamming::colorHamming($hammingValue), $crcSize))
            ->with('hammingValue', Hamming::colorString($hammingValue, [], $crcSize, true, false, false))
//            ->with('incorrectHammingValue',
//                Hamming::colorCRC(Hamming::colorHamming($incorrectHammingValue), $crcSize))
            ->with('incorrectHammingValue',
                Hamming::colorString($incorrectHammingValue, $errors, $crcSize, true, true, false))
//            ->with('fixedHammingValue',
//                Hamming::colorCRC(Hamming::colorHamming($fixedHammingValue), $crcSize))
            ->with('fixedHammingValue',
                Hamming::colorString($fixedHammingValue, $errors, $crcSize, true, true, true))
//            ->with('removedHammingValue', Hamming::colorCRC($removedHammingValue, $crcSize))
            ->with('removedHammingValue', Hamming::colorString($removedHammingValue, $errors, $crcSize, false, false, false))
            ->with('checkCrcValue', Hamming::colorCRCOnly($checkCrcValue, $crcSize))
            ->with('resultValue', $resultValue)
            ->with('valueOfFirstIncorrectByte', $valueOfFirstIncorrectByte)
            ->with('valueOfSecondIncorrectByte', $valueOfSecondIncorrectByte)
            ->with('valueOfThirdIncorrectByte', $valueOfThirdIncorrectByte)
            ->with('valueOfFourthIncorrectByte', $valueOfFourthIncorrectByte);
    }

    //Funkcja oblicza CRC dla podanego ciągu w zależności od użytego requesta
    function getCrcValue($request, $valueToConvert){
        $crcValue = '';
        switch ($request->input('crcButton')) {
            case 'CRC 16':
                $crcResult = new Crc16ARC();
                $crcValue = $crcResult->ComputeCrc($valueToConvert);
                break;
            case 'CRC 16 SDLC':
                $crcResult = new Crc16CCITT();
                $crcValue = $crcResult->ComputeCrc16False($valueToConvert);
                break;
            case 'CRC 32':
                $crcValue = crc32($valueToConvert);
                break;
        }
        return $crcValue;
    }

    //Zwraca rozmiar kodu crc, domyślnie 16 lub 32 dla CRC32
    function getCrcSize($request){
        $size = 16;
        if ($request->input('crcButton') == 'CRC 32') {
            $size = 32;
        }
        return $size;
    }


    function asc2bin($string)
    {
        $result = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $result .= sprintf("%08b", ord($string[$i]));
        }

        return $result;
    }

    function bin2ascii($bin)
    {
        $result = '';
        $len = strlen($bin);
        for ($i = 0; $i < $len; $i += 8) {
            $result .= chr(bindec(substr($bin, $i, 8)));
        }
        return $result;
    }
}

