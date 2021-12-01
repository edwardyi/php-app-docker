<?php

namespace edwardyi\Press\Http\Controllers;

use Illuminate\Routing\Controller;

class TestController extends Controller
{
    public function index()
    {
        return 'inside package tool test index';
    }
}