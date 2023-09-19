<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class AssetController extends Controller
{
    public function index()
    {
        $title = 'Tài sản';
        return view('asset.index', compact('title'));
    }

    public function data(Request $request)
    {
        $data = DB::table('asset');
        try {
            $domain = env('DOMAIN_IMAGE');
            $dataTable = DataTables::of(json_decode($data->get(), true))
                ->addColumn('image', function ($row) use ($domain) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['image'] . '" class="img-inline-name-data-table new cursor-pointer" onclick="openModalImageFullSize($(this))">';
                })
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('time', function ($row) {
                    return $this->formatDate($row['time']);
                })
                ->addIndexColumn()
                ->rawColumns(['image'])
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
            'description' => 'required|max:255',
            'image' => 'required',
            'amount' => 'required',
            'time' => 'required',
            'is_reserve_fund' => 'required',
        ]);
        if (!$validated) return $this->mapModelResponse(400, $validated->errors());

        DB::table('asset')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,
            'amount' => $request->amount,
            'time' => $request->time,
        ]);

        if ($request->is_reserve_fund == 1) {
            DB::table('reserve_fund')->insert([
                'description' => $request->description,
                'amount' => 0 - $request->amount,
                'time' => $request->time,
            ]);
        }

        return $this->mapModelResponse(200, 'Success');
    }
}
