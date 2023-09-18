<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Exception;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mapModelResponse($status, $message, $data = null)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ]);
    }

    public function catchTemplate($data, $e)
    {
        return [
            'Sql' => $data->toSql(),
            'File Error' => $e->getFile(),
            'Line Error' => $e->getLine(),
            'Error' => $e->getMessage()
        ];
    }

    public function numberFormat($num)
    {
        if (!is_numeric($num)) return $num;
        if (($num > 1000 || $num < -1000) && (fmod($num, 1) === 0.00)) {
            return number_format($num);
        } else {
            switch (strlen(substr(strrchr($num, "."), 1))) {
                case 0:
                    return number_format($num);
                case 1:
                    return number_format($num, 1);
                case 2:
                    return number_format($num, 2);
                default:
                    return number_format($num, 3);
            }
        }
    }

    public function keySearchDatatableTemplate($data)
    {
        try {
            foreach ($data as $db => $v) {
                if (gettype($v) === 'array') {
                    try {
                        $data[$db] = mb_strtolower(implode($v));
                    } catch (Exception $e) {
                        $data[$db] = '';
                    }
                }
            }
            $data = mb_strtolower(implode($data));
            $unicode = array(
                'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
                'd' => 'đ',
                'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
                'i' => 'í|ì|ỉ|ĩ|ị',
                'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
                'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
                'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            );
            foreach ($unicode as $nonUnicode => $uni) {
                $data = preg_replace("/($uni)/i", $nonUnicode, $data);
            }
            return str_replace(' ', '', $data);
        } catch (Exception $e) {
            dd($e, $data);
        }
    }

    public function formatDate($date)
    {
        return date_format(date_create($date), 'd/m/Y');
    }

    public function formatDateDayToMonth($date)
    {
        return date_format(date_create($date), 'm/Y');
    }
}
