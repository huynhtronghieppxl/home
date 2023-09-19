<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvestController extends Controller
{
    public function index()
    {
        $title = 'Báo cáo đầu tư';
        return view('report.invest', compact('title'));
    }
}
