<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    public function index()
    {
        $title = 'Báo cáo tiêu dùng';
        return view('report.reserve', compact('title'));
    }
}
