<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class AdditionFeeTypeController extends Controller
{
    public function index()
    {
        $title = 'Hạng mục thu chi';
        return view('addition_fee_type.index', compact('title'));
    }

    public function data(Request $request)
    {
        $data = DB::table('addition_fee_type')->where('status', 1);
        try {
            $dataTable = DataTables::of(json_decode($data->get(), true))
                ->addColumn('type', function ($row) {
                    if ($row['type'] === 1) {
                        return '<lable class="badge badge-danger">Hạng mục chi</lable>';
                    } else {
                        return '<lable class="badge badge-success">Hạng mục thu</lable>';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<div class="table-data-feature">
                               <button class="item crm-btn-data-table btn-warning mb-1" data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa" onclick="openModalUpdateAdditionFeeType(' . $row['id'] . ')">
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

    public function create(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'type' => 'required|between:0-1',
        ]);
        if (!$validated) return $this->mapModelResponse(400, $validated->errors());

        DB::table('addition_fee_type')->insert([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        return $this->mapModelResponse(200, 'Success');
    }

    public function update(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required|max:255',
        ]);
        if (!$validated) return $this->mapModelResponse(400, $validated->errors());

        $additionFeeType = DB::table('addition_fee_type')->where('id', $request->id)->count();

        if ($additionFeeType === 0) return $this->mapModelResponse(400, 'ID không tồn tại !');

        DB::table('addition_fee_type')->where('id', $request->id)->update([
            'name' => $request->name,
        ]);

        return $this->mapModelResponse(200, 'Success');
    }

    public function remove(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if (!$validated->fails()) return $this->mapModelResponse(400, $validated->errors());

        $additionFeeType = DB::table('addition_fee_type')->where('id', $request->id)->count();

        if ($additionFeeType === 0) return $this->mapModelResponse(400, 'ID không tồn tại !');

        DB::table('addition_fee_type')->where('id', $request->id)->update([
            'status' => 0,
        ]);

        return $this->mapModelResponse(200, 'Success');
    }
}
