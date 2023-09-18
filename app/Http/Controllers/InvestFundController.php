<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class InvestFundController extends Controller
{
    public function index()
    {
        $a = [1,6,4,2,8,9,5,5,9,9];
//        rsort($a);;
        dd(array_unique($a));
        dd(array_slice($a, 0, 5));
        $title = 'Đầu tư';
        return view('invest_fund.index', compact('title'));
    }

    public function data(Request $request)
    {
        $data = DB::table('invest_fund')->orderBy('time');
        try {
            $dataTable = DataTables::of(json_decode($data->get(), true))
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('time', function ($row) {
                    return $this->formatDate($row['amount']);
                })
                ->addIndexColumn()
                ->make(true);
            return [$dataTable, $data->toSql()];
        } catch (Exception $e) {
            return $this->catchTemplate($data, $e);
        }
    }

    public function period(Request $request)
    {
        $data = DB::table('invest_fund_period')->orderBy('time');
        try {
            $dataTable = DataTables::of(json_decode($data->get(), true))
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('begin', function ($row) {
                    return $this->numberFormat($row['begin']);
                })
                ->addColumn('total_in', function ($row) {
                    return $this->numberFormat($row['amount'] + $row['begin']);
                })
                ->addColumn('real_amount', function ($row) {
                    return $this->numberFormat($row['real_amount']);
                })
                ->addColumn('profit', function ($row) {
                    $total_in = $row['amount'] + $row['begin'];
                    $profit = $row['real_amount'] - $total_in;
                    $rate_profit = number_format(($profit / $total_in) * 100, 2);
                    $class = ($rate_profit > 0) ? 'fa fa-arrow-up text-success' : 'fa fa-arrow-down text-danger';
                    return '<div class="d-flex align-items-center justify-content-center">' . $profit . '
                                <i class="fa fa-exclamation-triangle text-success pl-1 mb-1 ' . $class . '">' . $rate_profit . '</i>
                            </div>';
                })
                ->addColumn('status', function ($row) {
                    if ($row['status'] === 1) {
                        return '<span class="badge badge-primary badge-size-sm">Đã chốt</span>';
                    } else {
                        return '<span class="badge badge-warning badge-size-sm">Chưa chốt</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    if ($row['status'] === 0) {
                        return '<div class="table-data-feature">
                                <button class="item crm-btn-data-table btn-success mb-1" data-toggle="tooltip" data-placement="top" data-original-title="Chốt kỳ" data-id="' . $row['id'] . '" onclick="openModalUpdate($(this))">
                                   <i class="fa fa-check"></i>
                                </button>
                            </div>';
                    } else {
                        return '';
                    }
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'profit', 'status'])
                ->make(true);
            return [$dataTable, $data->toSql()];
        } catch (Exception $e) {
            return $this->catchTemplate($data, $e);
        }
    }
}
