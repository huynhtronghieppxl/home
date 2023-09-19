<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class ReserveFundController extends Controller
{
    public function index()
    {
        $title = 'Quỹ tiêu dùng';
        return view('reserve_fund.index', compact('title'));
    }

    public function data(Request $request)
    {
        $data = DB::table('reserve_fund')
            ->where('status', 1)
            ->orderBy('time');
        try {
            $result = json_decode($data->get(), true);
            $dataTable = DataTables::of($result)
                ->addColumn('amount', function ($row) {
                    if ($row['amount'] < 0) {
                        return '<label class="badge badge-danger badge-size-md">' . $this->numberFormat($row['amount']) . '</label>';
                    } else {
                        return '<label class="badge badge-success badge-size-md"> ' . $this->numberFormat($row['amount']) . ' </label ';
                    }
                })
                ->addColumn('time', function ($row) {
                    return $this->formatDate($row['time']);
                })
                ->addColumn('action', function ($row) {
                    if ($row['amount'] < 0) {
                        return '<div class="table-data-feature">
                               <button class="item crm-btn-data-table btn-warning mb-1" data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa" data-id="' . $row['id'] . '" onclick="openModalUpdate($(this))">
                                   <i class="fa fa-pencil"></i>
                              </button>
                                <button class="item crm-btn-data-table btn-danger mb-1" data-toggle="tooltip" data-placement="top" data-original-title="Xoá" onclick="remove(' . $row['id'] . ')">
                                        <i class="fa fa-trash"></i>
                                </button>
                            </div>';
                    } else {
                        return '';
                    }
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'amount'])
                ->make(true);
            $collection = collect($result);
            $total = [
                'in' => $this->numberFormat($collection->where('amount', '>', 0)->sum('amount')),
                'out' => $this->numberFormat($collection->where('amount', '<', 0)->sum('amount')),
                'current' => $this->numberFormat($collection->sum('amount')),
            ];
            return [$dataTable, $total, $data->toSql()];
        } catch (Exception $e) {
            return $this->catchTemplate($data, $e);
        }
    }

    public function create(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'description' => 'required|max:255',
            'amount' => 'required',
            'time' => 'required',
        ]);
        if (!$validated) return $this->mapModelResponse(400, $validated->errors());

        DB::table('reserve_fund')->insert([
            'description' => $request->description,
            'amount' => 0 - $request->amount,
            'time' => $request->time,
        ]);

        return $this->mapModelResponse(200, 'Success');
    }

    public function update(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'id' => 'required',
            'description' => 'required|max:255',
            'amount' => 'required',
            'time' => 'required',
        ]);
        if (!$validated) return $this->mapModelResponse(400, $validated->errors());

        $additionFee = DB::table('reserve_fund')
            ->where('id', $request->id)
            ->where('status', 1)
            ->count();

        if ($additionFee === 0) return $this->mapModelResponse(400, 'ID không tồn tại !');

        DB::table('reserve_fund')->where('id', $request->id)->update([
            'description' => $request->description,
            'amount' => 0 - $request->amount,
            'time' => $request->time,
        ]);

        return $this->mapModelResponse(200, 'Success');
    }

    public function remove(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if (!$validated) return $this->mapModelResponse(400, $validated->errors());

        $additionFee = DB::table('reserve_fund')
            ->where('id', $request->id)
            ->where('status', 1)
            ->count();

        if ($additionFee === 0) return $this->mapModelResponse(400, 'ID không tồn tại !');

        DB::table('reserve_fund')->where('id', $request->id)->update([
            'status' => 0,
        ]);

        return $this->mapModelResponse(200, 'Success');
    }
}
