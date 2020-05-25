<?php

namespace App;

use function GuzzleHttp\Psr7\str;
use function Psy\bin;

class Hamming
{
    public static $powers = 0;
    public static $fix = -5;

    //Zwraca stringa z dołożonymi bitami hamminga
    public static function encodeHamming($encodedString): string
    {
        $hammingBitCount = 0;
        while (pow(2, $hammingBitCount) < ($hammingBitCount + strlen($encodedString) + 1)) {
            $hammingBitCount++;
        }
        self::$powers = $hammingBitCount;
//        var_dump('hammingBitsy', $hammingBitCount);
        for ($i = 0; $i < $hammingBitCount; $i++) {
            $encodedString = substr_replace($encodedString, '*', pow(2, $i) - 1, 0);
        }
        //var_dump($encodedString);

        for ($i = 0; $i < $hammingBitCount; $i++) {
            $currentBitValue = self::checkParityBitValue($encodedString, $i);
            //var_dump($currentBitValue);
            $encodedString = substr_replace($encodedString, $currentBitValue, pow(2, $i) - 1, 1);
        }
//        var_dump($encodedString);
        return $encodedString;
    }

    //Zwraca wartość bitu hamminga na podanym indeksie
    public static function checkParityBitValue($data, $i): int
    {
        $startIndex = pow(2, $i) - 1;
        $temp = array_filter(str_split(substr($data, $startIndex)), function ($k) use ($startIndex) {
//            var_dump($k % ((2 * ($startIndex + 1))) < $startIndex + 1, $k);
            return $k % ((2 * ($startIndex + 1))) < $startIndex + 1;
        }, ARRAY_FILTER_USE_KEY);
        array_shift($temp);
//                var_dump('shift', $temp);
        $temp = array_reduce($temp, function ($carry, $item) {
            return $carry xor $item;
        });
//        var_dump('reduce', $temp);

        return $temp;

    }

    //zwraca poprawiony kod hamminga
    public static function fixHamming($hammingValue, $incorrectHammingValue): string
    {
        $fixedHammingValue = $incorrectHammingValue;
        $invalidIndexes = [];
        for ($i = 0; $i < strlen($hammingValue); $i++)
            if ($hammingValue[$i] != $incorrectHammingValue[$i])
                array_push($invalidIndexes, $i);
//        var_dump('invalidIndexes', $invalidIndexes);

        if (sizeof($invalidIndexes) > 0) {
            $fixedHammingValue = self::flipBit($fixedHammingValue, array_sum($invalidIndexes));
            self::$fix = array_sum($invalidIndexes);
        }
        return $fixedHammingValue;
    }

    //obraca bit na danej pozycji
    public static function flipBit($array, $position)
    {
        $array = str_split($array);
        $array[$position] ^= 1;
        return implode('', $array);
    }

    //wprowadza przekłamania do stringu
    public static function enterErrors($errors, $incorrectHammingValue)
    {
        foreach ($errors as $error) {
            if ($error > 0) {
                $incorrectHammingValue = self::flipBit($incorrectHammingValue, $error);
            }
        }
        //var_dump('incorrectHammingValue', $incorrectHammingValue);
        return $incorrectHammingValue;
    }

    //usuwa bity hamminga
    public static function removeHammingBits($array)
    {
        for ($i = self::$powers; $i >= 0; $i--) {
            $array = substr_replace($array, '', pow(2, $i) - 1, 1);
        }
        //var_dump('removed', $array);
        return $array;
    }

    public static function colorHamming($array)
    {
        for ($i = self::$powers - 1; $i >= 0; $i--) {
            $array = substr_replace($array, '<span class="hamming">' . $array[pow(2, $i) - 1] . '</span>', pow(2, $i) - 1, 1);
        }
        return $array;
    }

    public static function colorCRC($array, $size)
    {
        $array = substr_replace($array, '<span class="CRC">', strlen($array) - $size, 0);
        $array = substr_replace($array, '</span>', strlen($array), 0);
        return $array;
    }

    public static function colorCRCOnly($array, $size)
    {

        if ($size == 16) {
            $array = sprintf("%016d", decbin($array));
        } else if ($size == 32) {
            $array = str_pad(decbin($array), 32, 0, STR_PAD_LEFT);
        }

        $array = substr_replace($array, '<span class="CRC">', 0, 0);
        $array = substr_replace($array, '</span>', strlen($array), 0);
        return $array;
    }

    public static function colorString($array, $errorIndexes, $size, $displayHamming, $displayfix, $afterFix)
    {
        $fixedIndexes = -200;

        $hammingIndexes = [];
        if ($displayHamming) {
            for ($i = self::$powers - 1; $i >= 0; $i--) {
                array_push($hammingIndexes, pow(2, $i) - 1);
            }
            $fixedIndexes = self::$fix;
        }

        if (!$displayfix) {
            $fixedIndexes = 80000000;
            $errorIndexes = [];
        }



        $crcIndexes = [];
        for ($i = strlen($array); $i >= strlen($array) - $size; $i--) {
            array_push($crcIndexes, $i);
        }

        $CHFstring = '<span class="CRC hamming fixedBit">';
        $CHEstring = '<span class="CRC hamming errorBit">';
        $CEstring = '<span class="CRC errorBit">';
        $CFstring = '<span class="CRC fixedBit">';
        $CHstring = '<span class="CRC hamming">';
        $Cstring = '<span class="CRC">';
        $HFstring = '<span class="hamming fixedBit">';
        $HEstring = '<span class="hamming errorBit">';
        $Fstring = '<span class="fixedBit">';
        $Estring = '<span class="errorBit">';
        $Hstring = '<span class="hamming">';
        $Endstring = '</span>';

        for ($i = strlen($array) - 1; $i >= 0; $i--) {
             if (in_array($i, $crcIndexes) && in_array($i, $hammingIndexes) && $i == $fixedIndexes && in_array($i, $errorIndexes) && $afterFix) {
                $array = substr_replace($array, $CHstring, $i, 0);
                $array = substr_replace($array, $Endstring, $i + strlen($CHFstring) + 1, 0);
            } else if (in_array($i, $crcIndexes) && in_array($i, $hammingIndexes) && $i == $fixedIndexes && in_array($i, $errorIndexes)) {
                $array = substr_replace($array, $CHEstring, $i, 0);
                $array = substr_replace($array, $Endstring, $i + strlen($CHEstring) + 1, 0);
            } else if (in_array($i, $crcIndexes) && in_array($i, $hammingIndexes) && in_array($i, $errorIndexes)) {
                $array = substr_replace($array, $CHEstring, $i, 0);
                $array = substr_replace($array, $Endstring, $i + strlen($CHEstring) + 1, 0);
            } else if (in_array($i, $crcIndexes) && in_array($i, $hammingIndexes) && $i == $fixedIndexes  && $afterFix) {
                $array = substr_replace($array, $CHFstring, $i, 0);
                $array = substr_replace($array, $Endstring, $i + strlen($CHFstring) + 1, 0);
            } else if (in_array($i, $crcIndexes) && in_array($i, $hammingIndexes)) {
                $array = substr_replace($array, $CHstring, $i, 0);
                $array = substr_replace($array, $Endstring, $i + strlen($CHstring) + 1, 0);
            }

             else if (in_array($i, $crcIndexes) && in_array($i, $errorIndexes)) {
                $array = substr_replace($array, $CEstring, $i, 0);
                $array = substr_replace($array, $Endstring, $i + strlen($CEstring) + 1, 0);
            }  else if (in_array($i, $crcIndexes) && $i == $fixedIndexes  && $afterFix) {
                $array = substr_replace($array, $CFstring, $i, 0);
                $array = substr_replace($array, $Endstring, $i + strlen($CFstring) + 1, 0);
            }


             else if (in_array($i, $crcIndexes)) {
                $array = substr_replace($array, $Cstring, $i, 0);
                $array = substr_replace($array, $Endstring, $i + strlen($Cstring) + 1, 0);
            } else if (in_array($i, $hammingIndexes) && $i == $fixedIndexes  && $afterFix) {
                $array = substr_replace($array, $HFstring, $i, 0);
                $array = substr_replace($array, $Endstring, $i + strlen($HFstring) + 1, 0);
            } else if (in_array($i, $hammingIndexes) && in_array($i, $errorIndexes)) {
                $array = substr_replace($array, $HEstring, $i, 0);
                $array = substr_replace($array, $Endstring, $i + strlen($HEstring) + 1, 0);
            } else if ($i == $fixedIndexes && in_array($i, $errorIndexes) && $afterFix) {
                $array = substr_replace($array, $Fstring, $i, 0);
                $array = substr_replace($array, $Endstring, $i + strlen($Fstring) + 1, 0);
            } else if ($i == $fixedIndexes && in_array($i, $errorIndexes)) {
                $array = substr_replace($array, $Estring, $i, 0);
                $array = substr_replace($array, $Endstring, $i + strlen($Estring) + 1, 0);
            } else if ($i == $fixedIndexes  && $afterFix) {
                $array = substr_replace($array, $Fstring, $i, 0);
                $array = substr_replace($array, $Endstring, $i + strlen($Fstring) + 1, 0);
            } else if (in_array($i, $errorIndexes)) {
                $array = substr_replace($array, $Estring, $i, 0);
                $array = substr_replace($array, $Endstring, $i + strlen($Estring) + 1, 0);
            } else if (in_array($i, $hammingIndexes)) {
                $array = substr_replace($array, $Hstring, $i, 0);
                $array = substr_replace($array, $Endstring, $i + strlen($Hstring) + 1, 0);
            }
        }

        return $array;


    }
}
