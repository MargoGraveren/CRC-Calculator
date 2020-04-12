<?php

namespace App\Http\Controllers;

use App\Crc16;
use App\CrcParams;
use Illuminate\Http\Request;

class CrcController extends Controller
{
    public function index(){
        return view('index');
    }

    public function store(Request $request){
        $valueToConvert = $request->input('valueToConvert');

        $valueInBinary = $this->asc2bin($valueToConvert);
        return view('crc')->with('valueToConvert', $valueToConvert)->with('valueInBinary', $valueInBinary);
    }

    function asc2bin($string)
    {
        $result = '';
        $len = strlen($string);
        for ($i = 0; $i < $len; $i++)
        {
            $result .= sprintf("%08b", ord($string{$i}));
        }
        return $result;
    }

    function bin2ascii($bin)
    {
        $result = '';
        $len = strlen($bin);
        for ($i = 0; $i < $len; $i += 8)
        {
            $result .= chr(bindec(substr($bin, $i, 8)));
        }
        return $result;
    }
}