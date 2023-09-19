<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class RevenueController extends Controller
{
    public function index()
    {
        $title = 'Báo cáo doanh thu';
        return view('report.revenue', compact('title'));
    }

    public function data(Request $request)
    {
        $data = DB::table('addition_fee')
            ->select('addition_fee_type.name', DB::raw('SUM(amount)'))
            ->where('addition_fee.status', 1)
            ->whereBetween('addition_fee.time', [$request->from, $request->to])
            ->leftJoin('addition_fee_type', 'addition_fee.addition_fee_type_id', '=', 'addition_fee_type.id')
            ->where('addition_fee_type.type', 0)
            ->groupBy('addition_fee_type.id');
        try {
            $result = json_decode($data->get(), true);
            $dataChartPie = [];
            foreach ($result as $db) {
                $dataChartPie[] = [
                    "name" => $db['name'],
                    "value" => $db['sum'],
                ];
            }
            return [$dataChartPie, collect($dataChartPie)->sum('value'), $data->toSql()];
        } catch (Exception $e) {
            return $this->catchTemplate($data, $e);
        }
    }

    public function all(Request $request)
    {
        $data = DB::table('addition_fee')
            ->select(DB::raw("TO_CHAR(CAST(time AS DATE), 'MM/YYYY') AS month, SUM(amount) AS total_amount"))
            ->leftJoin('addition_fee_type', 'addition_fee.addition_fee_type_id', '=', 'addition_fee_type.id')
            ->where('addition_fee_type.type', 0)
            ->groupBy(DB::raw("TO_CHAR(CAST(time AS DATE), 'MM/YYYY')"))
            ->orderByRaw("TO_DATE(TO_CHAR(CAST(time AS DATE), 'MM/YYYY'), 'MM/YYYY')");
        try {
            $result = collect(json_decode($data->get(), true));
            $dataChartLine = [
                'timeline' => $result->pluck('month'),
                'value' => $result->pluck('total_amount'),
            ];
            return [$dataChartLine, $data->toSql()];
        } catch (Exception $e) {
            return $this->catchTemplate($data, $e);
        }
    }
}
