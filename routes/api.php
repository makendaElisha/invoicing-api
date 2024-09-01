<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceItemController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\BankingDetailsController;
use App\Http\Controllers\BusinessSettingController;
use App\Http\Controllers\ClientController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('invoice-items', InvoiceItemController::class);
Route::apiResource('invoices', InvoiceController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('addresses', AddressController::class);
Route::apiResource('banking-details', BankingDetailsController::class);
Route::apiResource('business-settings', BusinessSettingController::class);
Route::apiResource('clients', ClientController::class);



