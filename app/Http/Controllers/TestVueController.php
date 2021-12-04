<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestVueController extends Controller
{
    public function index()
    {
        return [
            'test' => 'something inside'
        ];
    }
}
