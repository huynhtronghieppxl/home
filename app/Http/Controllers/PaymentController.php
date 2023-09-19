<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class PaymentController extends Controller
{
    public function index()
    {
        $title = 'Phiếu chi';
        return view('payment.index', compact('title'));
    }

    public function data(Request $request)
    {
        $data = DB::table('addition_fee')
            ->where('addition_fee.status', 1)
            ->whereBetween('addition_fee.time', [$request->from, $request->to])
            ->leftJoin('addition_fee_type', 'addition_fee.addition_fee_type_id', '=', 'addition_fee_type.id')
            ->where('addition_fee_type.type', 1)
            ->orderBy('time', 'asc');
        if ($request->type !== '-1') {
            $data->where('addition_fee_type.id', $request->type);
        }
        try {
            $dataTable = DataTables::of(json_decode($data->get(), true))
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('type', function ($row) {
                    return $row['name'];
                })
                ->addColumn('time', function ($row) {
                    return $this->formatDate($row['time']);
                })
                ->addColumn('action', function ($row) {
                    return '<div class="table-data-feature">
                               <button class="item crm-btn-data-table btn-warning mb-1" data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa" data-id="' . $row['id'] . '" data-type="' . $row['addition_fee_type_id'] . '" onclick="openModalUpdate($(this))">
                                   <i class="fa fa-pencil"></i>
                              </button>
                                <button class="item crm-btn-data-table btn-danger mb-1" data-toggle="tooltip" data-placement="top" data-original-title="Xoá" onclick="remove(' . $row['id'] . ')">
                                        <i class="fa fa-trash"></i>
                                </button>
                            </div>';
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'type'])
                ->make(true);
            return [$dataTable, $data->toSql()];
        } catch (Exception $e) {
            return $this->catchTemplate($data, $e);
        }
    }

    public function dataType(Request $request)
    {
        $data = DB::table('addition_fee_type')
            ->where('type', 1)
            ->where('status', 1);
        try {
            $option = '';
            foreach (json_decode($data->get(), true) as $db) {
                $option .= '<option value="' . $db['id'] . '" >' . $db['name'] . '</option>';
            }
            return [$option, $data->toSql()];
        } catch (Exception $e) {
            return $this->catchTemplate($data, $e);
        }
    }

    public function create(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'description' => 'required|max:255',
            'addition_fee_type_id' => 'required',
            'amount' => 'required',
            'time' => 'required',
        ]);
        if (!$validated) return $this->mapModelResponse(400, $validated->errors());

        DB::table('addition_fee')->insert([
            'description' => $request->description,
            'addition_fee_type_id' => $request->addition_fee_type_id,
            'amount' => $request->amount,
            'time' => $request->time,
        ]);

        DB::table('fund_period')->where('time', $this->formatDateDayToMonth($request->time))
            ->increment('payment', $request->amount);

        return $this->mapModelResponse(200, 'Success');
    }

    public function update(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'id' => 'required',
            'description' => 'required|max:255',
            'addition_fee_type_id' => 'required',
            'amount' => 'required',
            'time' => 'required',
        ]);
        if (!$validated) return $this->mapModelResponse(400, $validated->errors());

        $additionFee = DB::table('addition_fee')->where('id', $request->id)->count();

        if ($additionFee === 0) return $this->mapModelResponse(400, 'ID không tồn tại !');

        DB::table('addition_fee')->where('id', $request->id)->update([
            'description' => 'required|max:255',
            'addition_fee_type_id' => 'required',
            'amount' => 'required',
            'time' => 'required',
        ]);

        $amount = $request->amount - $additionFee['amount'];
        DB::table('fund_period')->where('time', $this->formatDateDayToMonth($request->time))
            ->increment('payment', $amount);

        return $this->mapModelResponse(200, 'Success');
    }

    public function remove(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if (!$validated->fails()) return $this->mapModelResponse(400, $validated->errors());

        $additionFee = DB::table('addition_fee')->where('id', $request->id)->count();

        if ($additionFee === 0) return $this->mapModelResponse(400, 'ID không tồn tại !');

        DB::table('addition_fee')->where('id', $request->id)->update([
            'status' => 0,
        ]);

        DB::table('fund_period')->where('time', $this->formatDateDayToMonth($additionFee['time']))
            ->decrement('payment', $additionFee['amount']);

        return $this->mapModelResponse(200, 'Success');
    }
}
