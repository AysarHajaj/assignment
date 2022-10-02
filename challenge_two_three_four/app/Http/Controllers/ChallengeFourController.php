<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChallengeFourController extends Controller
{
    public function groupByCompanyName(Request $request)
    {
        $data = $request->input('data');
        $result = [];
        foreach ($data as $key => $value) {
            if (isset($result[$value])) {
                $result[$value][] = $key;
            } else {
                $result[$value] = [$key];
            }
        }

        return $result;
    }
}
