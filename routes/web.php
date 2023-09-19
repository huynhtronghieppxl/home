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
    $title = 'Trang chủ';
    return view('index', compact('title'));
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
Route::post('fund-period.confirm', ['as' => 'fund-period.confirm', 'uses' => 'App\Http\Controllers\FundPeriodController@confirm']);

/**
 * Event
 */
Route::resource('event', 'App\Http\Controllers\EventController');
Route::get('event.data', ['as' => 'event.data', 'uses' => 'App\Http\Controllers\EventController@data']);
/**
 * Tài sản
 */
Route::resource('asset', 'App\Http\Controllers\AssetController');
Route::get('asset.data', ['as' => 'asset.data', 'uses' => 'App\Http\Controllers\AssetController@data']);
Route::post('asset.create', ['as' => 'asset.create', 'uses' => 'App\Http\Controllers\AssetController@create']);
/**
 * Ghi chú
 */
Route::resource('note', 'App\Http\Controllers\NoteController');
Route::get('note.data', ['as' => 'note.data', 'uses' => 'App\Http\Controllers\NoteController@data']);
Route::post('note.update', ['as' => 'note.update', 'uses' => 'App\Http\Controllers\NoteController@update']);

/**
 * Đầu tư
 */
Route::resource('invest-fund', 'App\Http\Controllers\InvestFundController');
Route::get('invest-fund.data', ['as' => 'invest-fund.data', 'uses' => 'App\Http\Controllers\InvestFundController@data']);
Route::get('invest-fund.period', ['as' => 'invest-fund.period', 'uses' => 'App\Http\Controllers\InvestFundController@period']);
Route::post('invest-fund.update', ['as' => 'invest-fund.update', 'uses' => 'App\Http\Controllers\InvestFundController@update']);
Route::post('invest-fund.confirm', ['as' => 'invest-fund.confirm', 'uses' => 'App\Http\Controllers\InvestFundController@confirm']);

/**
 * Tiêu dùng
 */
Route::resource('reserve-fund', 'App\Http\Controllers\ReserveFundController');
Route::get('reserve-fund.data', ['as' => 'reserve-fund.data', 'uses' => 'App\Http\Controllers\ReserveFundController@data']);
Route::post('reserve-fund.create', ['as' => 'reserve-fund.create', 'uses' => 'App\Http\Controllers\ReserveFundController@create']);
Route::post('reserve-fund.update', ['as' => 'reserve-fund.update', 'uses' => 'App\Http\Controllers\ReserveFundController@update']);
Route::post('reserve-fund.remove', ['as' => 'reserve-fund.remove', 'uses' => 'App\Http\Controllers\ReserveFundController@remove']);
/**
 * Báo cáo doanh thu
 */
Route::resource('revenue-report', 'App\Http\Controllers\Report\RevenueController');
Route::get('revenue-report.data', ['as' => 'revenue-report.data', 'uses' => 'App\Http\Controllers\Report\RevenueController@data']);
Route::get('revenue-report.all', ['as' => 'revenue-report.all', 'uses' => 'App\Http\Controllers\Report\RevenueController@all']);
/**
 * Báo cáo chi phí
 */
Route::resource('cost-report', 'App\Http\Controllers\Report\CostController');
Route::get('cost-report.data', ['as' => 'cost-report.data', 'uses' => 'App\Http\Controllers\Report\CostController@data']);
Route::get('cost-report.all', ['as' => 'cost-report.all', 'uses' => 'App\Http\Controllers\Report\CostController@all']);

/**
 * Báo cáo tiêu dùng
 */
Route::resource('reserve-report', 'App\Http\Controllers\Report\ReserveController');
/**
 * Báo cáo đầu tư
 */
Route::resource('invest-report', 'App\Http\Controllers\Report\InvestController');
/**
 * Thiết lập
 */
Route::resource('setting', 'App\Http\Controllers\SettingController');
/**
 * Upload
 */
Route::post('upload-media-template', ['as' => 'upload-media-template', 'uses' => 'App\Http\Controllers\UploadController@uploadMedia']);
