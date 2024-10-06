<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\AttendeeController;
use App\Http\Controllers\API\AuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])
->middleware('auth:sanctum');

// Publicly accessible routes
// -- Events
Route::get('events', [EventController::class, 'index']);
Route::get('events/{event}', [EventController::class, 'show']);
 
// -- Event Attendees
Route::get('events/{event}/attendees', [AttendeeController::class, 'index']);
Route::get('events/{event}/attendees/{attendee}', [AttendeeController::class, 'show']);
 
// Authenticated event routes
Route::middleware('auth:sanctum')->group(function () {
 
    // Events
    Route::post('events', [EventController::class, 'store']);
    Route::put('events/{event}', [EventController::class, 'update']);
    Route::delete('events/{event}', [EventController::class, 'destroy']);
 
    // Event Attendees
    Route::delete('events/{event}/attendees/{attendee}', [AttendeeController::class, 'destroy']);
    Route::post('events/{event}/attendees', [AttendeeController::class, 'store']);
});