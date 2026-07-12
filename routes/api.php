<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// ===============================etqan_visitors ===============================
// P0-11 fix: rate-limit the public visitor endpoints to prevent abuse.

// get visitors count — read-only, light rate limit
Route::get('/etqan_visitors', function () {
    try {
        $visitor = \App\Models\EtqanVisitor::first();
        $data = [
            'message' => 'success',
            'count' => $visitor ? $visitor->count : 0,
        ];
        return response()->json($data, 200);
    } catch (\Exception $ex) {
        // P0-11 fix: do not leak internal error messages
        \Log::error('etqan_visitors error: ' . $ex->getMessage());
        return response()->json(['message' => 'error'], 500);
    }
})->middleware('throttle:60,1');

// increment visitors count — heavier rate limit to prevent counter inflation
Route::get('/etqan_visitors/increment', function () {
    try {
        $visitor = \App\Models\EtqanVisitor::first();
        if (!$visitor) {
            return response()->json(['message' => 'error'], 500);
        }
        $visitor->count = $visitor->count + 1;
        $visitor->save();
        $data = [
            'message' => 'success',
            'count' => $visitor->count,
        ];
        return response()->json($data, 200);
    } catch (\Exception $ex) {
        \Log::error('etqan_visitors increment error: ' . $ex->getMessage());
        return response()->json(['message' => 'error'], 500);
    }
})->middleware('throttle:30,1');
