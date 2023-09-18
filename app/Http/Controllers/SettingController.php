<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $title = 'Thiết lập';
        return view('setting.index', compact('title'));
    }
}
