<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function data(Request $request)
    {
        $data = DB::table('users');
        try {
            $dataTable = DataTables::of(json_decode($data->get(), true))
                ->addColumn('status', function ($row) {
                    if ($row['status'] === 0) {
                        return '<lable class="badge badge-danger">Close</lable>';
                    } else {
                        return '<lable class="badge badge-success">Open</lable>';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '';
                })
                ->addIndexColumn()
                ->rawColumns(['status'])
                ->make(true);
            return [$dataTable, $data->toSql()];
        } catch (Exception $e) {
            return $this->catchTemplate($data, $e);
        }
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|between:2,100|unique:users',
            'name' => 'required|string|between:2,100',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }
}
