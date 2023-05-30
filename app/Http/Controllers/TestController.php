<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function test_api()
    {
        $posts = Http::get('https://jsonplaceholder.typicode.com/posts')->json();

        return view('test_api', compact('posts'));
    }

    public function weather_api()
    {
        return view('weather_api');
    }
}
