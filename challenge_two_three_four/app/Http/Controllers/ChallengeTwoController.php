<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChallengeTwoController extends Controller
{
    public function getRedundantNumbers(Request $request)
    {
        $numbers = $request->input('numbers');;
        $data = [];
        foreach ($numbers as $number) {
            if (isset($data[$number])) {
                $data[$number] = $data[$number] + 1;
            } else {
                $data[$number] = 1;
            }
        }

        $result = "";
        foreach ($data as $key => $value) {
            if ($value > 1) {
                $result = $result . $key . " ";
            }
        }

        return $result;
    }
}
