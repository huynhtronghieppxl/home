<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $title = 'Sự kiện';
        return view('event.index', compact('title'));
    }
}
