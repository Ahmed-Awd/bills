<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('login', [AuthController::class, 'login'])->middleware(['throttle:25,1']);
Route::middleware('auth:api')->group(function () {
    Route::group(['middleware' => ['role:customer']], function () {
        Route::post('bills/generate/invoice', [BillController::class, 'generateInvoice']);
        Route::post('bills/send-via/mail/{bill}', [BillController::class, 'sendInvoiceViaMail']);
        Route::post('bills/monthly/send-via/mail', [BillController::class, 'sendMonthlyInvoicesViaMail']);
    });

});
