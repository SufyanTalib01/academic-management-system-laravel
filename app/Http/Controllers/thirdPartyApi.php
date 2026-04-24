<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\returnValue;

class thirdPartyApi extends Controller
{
    public function getApiData()
    {
        $data = Http::withoutVerifying()->get(url: 'https://jsonplaceholder.typicode.com/users');
        $respone = $data->json();
        return view('api.third_api')->with('items', $respone);
    }
}
