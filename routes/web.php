<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/', function () {
    return view('index');
});

/**
 * User
 */
Route::resource('user', 'App\Http\Controllers\UserController');
Route::get('user.data', ['as' => 'user.data', 'uses' => 'App\Http\Controllers\UserController@data']);
/**
 * Hạng mục thu chi
 */
Route::resource('addition-fee-type', 'App\Http\Controllers\AdditionFeeTypeController');
Route::get('addition-fee-type.data', ['as' => 'addition-fee-type.data', 'uses' => 'App\Http\Controllers\AdditionFeeTypeController@data']);
Route::post('addition-fee-type.create', ['as' => 'addition-fee-type.create', 'uses' => 'App\Http\Controllers\AdditionFeeTypeController@create']);
Route::post('addition-fee-type.update', ['as' => 'addition-fee-type.update', 'uses' => 'App\Http\Controllers\AdditionFeeTypeController@update']);
Route::post('addition-fee-type.remove', ['as' => 'addition-fee-type.remove', 'uses' => 'App\Http\Controllers\AdditionFeeTypeController@remove']);
/**
 * Phiếu thu
 */
Route::resource('receipt', 'App\Http\Controllers\ReceiptController');
Route::get('receipt.data', ['as' => 'receipt.data', 'uses' => 'App\Http\Controllers\ReceiptController@data']);
Route::get('receipt.data-type', ['as' => 'receipt.data-type', 'uses' => 'App\Http\Controllers\ReceiptController@dataType']);
Route::post('receipt.create', ['as' => 'receipt.create', 'uses' => 'App\Http\Controllers\ReceiptController@create']);
Route::post('receipt.update', ['as' => 'receipt.update', 'uses' => 'App\Http\Controllers\ReceiptController@update']);
Route::post('receipt.remove', ['as' => 'receipt.remove', 'uses' => 'App\Http\Controllers\ReceiptController@remove']);
/**
 * Phiếu chi
 */
Route::resource('payment', 'App\Http\Controllers\PaymentController');
Route::get('payment.data', ['as' => 'payment.data', 'uses' => 'App\Http\Controllers\PaymentController@data']);
Route::get('payment.data-type', ['as' => 'payment.data-type', 'uses' => 'App\Http\Controllers\PaymentController@dataType']);
Route::post('payment.create', ['as' => 'payment.create', 'uses' => 'App\Http\Controllers\PaymentController@create']);
Route::post('payment.update', ['as' => 'payment.update', 'uses' => 'App\Http\Controllers\PaymentController@update']);
Route::post('payment.remove', ['as' => 'payment.remove', 'uses' => 'App\Http\Controllers\PaymentController@remove']);
/**
 * Kỳ quỹ
 */
Route::resource('fund-period', 'App\Http\Controllers\FundPeriodController');
Route::get('fund-period.data', ['as' => 'fund-period.data', 'uses' => 'App\Http\Controllers\FundPeriodController@data']);
Route::post('fund-period.fund-allocation', ['as' => 'fund-period.fund-allocation', 'uses' => 'App\Http\Controllers\FundPeriodController@fundAllocation']);
Route::post('fund-period.end', ['as' => 'fund-period.end', 'uses' => 'App\Http\Controllers\FundPeriodController@endPeriod']);

/**
 * Event
 */
Route::resource('event', 'App\Http\Controllers\EventController');
//Route::get('addition-fee.data', ['as' => 'addition-fee.data', 'uses' => 'App\Http\Controllers\AdditionFeeController@data']);
//Route::post('addition-fee.create', ['as' => 'addition-fee.create', 'uses' => 'App\Http\Controllers\AdditionFeeController@create']);
//Route::post('addition-fee.update', ['as' => 'addition-fee.update', 'uses' => 'App\Http\Controllers\AdditionFeeController@update']);
//Route::post('addition-fee.remove', ['as' => 'addition-fee.remove', 'uses' => 'App\Http\Controllers\AdditionFeeController@remove']);
/**
 * Tài sản
 */
Route::resource('asset', 'App\Http\Controllers\AssetController');
Route::get('asset.data', ['as' => 'asset.data', 'uses' => 'App\Http\Controllers\AssetController@data']);
Route::post('asset.create', ['as' => 'asset.create', 'uses' => 'App\Http\Controllers\AssetController@create']);

/**
 * Đầu tư
 */
Route::resource('invest-fund', 'App\Http\Controllers\InvestFundController');
Route::get('invest-fund.data', ['as' => 'invest-fund.data', 'uses' => 'App\Http\Controllers\InvestFundController@data']);
Route::get('invest-fund.period', ['as' => 'invest-fund.period', 'uses' => 'App\Http\Controllers\InvestFundController@period']);

/**
 * Tiêu dùng
 */
Route::resource('reserve-fund', 'App\Http\Controllers\ReserveFundController');
Route::get('invest-fund.data', ['as' => 'invest-fund.data', 'uses' => 'App\Http\Controllers\ReserveFundController@data']);
Route::post('invest-fund.create', ['as' => 'invest-fund.create', 'uses' => 'App\Http\Controllers\ReserveFundController@create']);
Route::post('invest-fund.update', ['as' => 'invest-fund.update', 'uses' => 'App\Http\Controllers\ReserveFundController@update']);
Route::post('invest-fund.remove', ['as' => 'invest-fund.remove', 'uses' => 'App\Http\Controllers\ReserveFundController@remove']);
/**
 * Báo cáo
 */
Route::resource('report', 'App\Http\Controllers\ReportController');
/**
 * Thiết lập
 */
Route::resource('setting', 'App\Http\Controllers\SettingController');
/**
 * Upload
 */
Route::post('upload-media-template', ['as' => 'upload-media-template', 'uses' => 'App\Http\Controllers\UploadController@uploadMedia']);
