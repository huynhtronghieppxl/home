<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class FundPeriodController extends Controller
{
    public function index()
    {
        $title = 'Kỳ quỹ';
        return view('fund_period.index', compact('title'));
    }

    public function data(Request $request)
    {
        $data = DB::table('fund_period')
            ->orderBy('time');
        try {
            $dataTable = DataTables::of(json_decode($data->get(), true))
                ->addColumn('begin', function ($row) {
                    return $this->numberFormat($row['begin']);
                })
                ->addColumn('receipt', function ($row) {
                    return $this->numberFormat($row['receipt']);
                })
                ->addColumn('payment', function ($row) {
                    return $this->numberFormat($row['payment']);
                })
                ->addColumn('reserve_fund', function ($row) {
                    return $this->numberFormat($row['reserve_fund']);
                })
                ->addColumn('invest_fund', function ($row) {
                    return $this->numberFormat($row['invest_fund']);
                })
                ->addColumn('ending_balance', function ($row) {
                    $amount = $row['begin'] - $row['payment'];
                    return $this->numberFormat($amount);
                })
                ->addColumn('surplus', function ($row) {
                    $amount = $row['receipt'] - $row['begin'] - $row['reserve_fund'] - $row['invest_fund'];
                    return $this->numberFormat($amount);
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
                                <button class="item crm-btn-data-table btn-warning mb-1" data-toggle="tooltip" data-placement="top" data-original-title="Phân bổ" data-id="' . $row['id'] . '" onclick="openModalFundAllocation($(this))">
                                   <i class="fa fa-external-link-square"></i>
                                </button>
                                <button class="item crm-btn-data-table btn-success mb-1" data-toggle="tooltip" data-placement="top" data-original-title="Chốt kỳ" data-id="' . $row['id'] . '" onclick="confirm($(this))">
                                   <i class="fa fa-check"></i>
                                </button>
                            </div>';
                    } else {
                        return '';
//                        return '<div class="table-data-feature">
//                                <button class="item crm-btn-data-table btn-primary mb-1" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" onclick="openModalDetail(' . $row['id'] . ')">
//                                        <i class="fa fa-reorder"></i>
//                                </button>
//                            </div>';
                    }
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'status'])
                ->make(true);
            return [$dataTable, $data->toSql()];
        } catch (Exception $e) {
            return $this->catchTemplate($data, $e);
        }
    }

    public function fundAllocation(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'id' => 'required',
            'reserve_fund' => 'required',
            'invest_fund' => 'required',
        ]);
        if (!$validated) return $this->mapModelResponse(400, $validated->errors());

        DB::table('fund_period')->where('id', $request->id)->update([
            'reserve_fund' => $request->reserve_fund,
            'invest_fund' => $request->invest_fund,
        ]);

        DB::table('reserve_fund')->insert([
            'amount' => $request->reserve_fund,
            'description' => 'Tăng định kỳ',
            'time' => date('m/d/Y'),
        ]);

        DB::table('invest_fund')->insert([
            'amount' => $request->invest_fund,
            'description' => 'Tăng định kỳ',
            'time' => date('m/d/Y'),
        ]);

        DB::table('invest_fund_period')->where('time', date('m/Y'))
            ->increment('amount', $request->invest_fund);

        return $this->mapModelResponse(200, 'Success');
    }

    public function confirm(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if (!$validated) return $this->mapModelResponse(400, $validated->errors());

        $fundPeriod = DB::table('fund_period')
            ->where('id', $request->id)
            ->where('status', 0)
            ->first();

        if (!$fundPeriod) return $this->mapModelResponse(400, 'Dữ liệu không hợp lệ !');

        $amount = $fundPeriod->begin - $fundPeriod->payment;

        DB::table('fund_period')->where('id', $request->id)->update([
            'status' => 1,
            'reserve_fund' => $fundPeriod->reserve_fund + $amount,
        ]);

        DB::table('reserve_fund')->insert([
            'amount' => $amount,
            'description' => 'Tăng cuối kỳ còn dư',
            'time' => date('m/d/Y'),
        ]);

        return $this->mapModelResponse(200, 'Success');
    }
}
