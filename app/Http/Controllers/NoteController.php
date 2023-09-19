<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class NoteController extends Controller
{
    public function index()
    {
        $title = 'Ghi chú';
        return view('note.index', compact('title'));
    }

    public function data(Request $request)
    {
        $data = DB::table('note')
            ->where('status', 1);
        try {
            return [1, $data->toSql()];
        } catch (Exception $e) {
            return $this->catchTemplate($data, $e);
        }
    }

    public function update(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
        if (!$validated) return $this->mapModelResponse(400, $validated->errors());

        $additionFee = DB::table('note')->where('id', $request->id)->count();

        if ($additionFee === 0) {
            if ($request->id == 0) {
                DB::table('note')->insert([
                    'title' => $request->title,
                    'content' => $request->description,
                ]);
            } else {
                return $this->mapModelResponse(400, 'Dữ liệu không hợp lệ !');
            }
        } else {
            DB::table('note')->where('id', $request->id)->update([
                'title' => $request->title,
                'content' => $request->description,
            ]);
        }

        return $this->mapModelResponse(200, 'Success');
    }

    public function remove(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if (!$validated->fails()) return $this->mapModelResponse(400, $validated->errors());

        $additionFee = DB::table('note')->where('id', $request->id)->count();

        if ($additionFee === 0) return $this->mapModelResponse(400, 'ID không tồn tại !');

        DB::table('note')->where('id', $request->id)->update([
            'status' => 0,
        ]);

        return $this->mapModelResponse(200, 'Success');
    }
}
