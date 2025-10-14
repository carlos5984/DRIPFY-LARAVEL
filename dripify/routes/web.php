<?php


use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AttendanceSessionController;
Route::get('/', function () {
    return view('welcome');
});

Route::view('/register', 'register')->name('register');
Route::post('/register' , RegisterController::class)->name('register.store');

Route::view('/login','login')->name('login');
Route::post('/login', LoginController::class)->name('login.attempt');


Route::post('/logout', function(){
    Auth::guard('web')->logout();
    Session::invalidate();
    Session::regenerateToken();
    return redirect('/');
})->name('logout');

//pprt nao suporto mais


// Authenticated User Routes
// -------------------------------------------------------------------------
Route::middleware('auth')->group(function () {

    // -- Dashboard
    // The main landing page after a user logs in.

    Route::view('/dashboard','dashboard')->name('dashboard');

    // -- Event Management (CRUD for Organizers)
    // Route::resource provides all the standard routes for creating, reading, updating, and deleting events.
    // GET /events -> index() -> Show list of events
    // GET /events/create -> create() -> Show form to create event
    // POST /events -> store() -> Save a new event
    // GET /events/{event} -> show() -> Show a single event's details (and participant list)
    // GET /events/{event}/edit -> edit() -> Show form to edit event
    // PUT/PATCH /events/{event} -> update() -> Save changes to an event
    // DELETE /events/{event} -> destroy() -> Delete an event
    Route::resource('events', EventController::class);

    // -- Participant Management (nested under a specific event)
    // A dedicated page to view and manage participants for an event.
   // Route::get('/events/{event}/participants', [ParticipantController::class, 'index'])->name('events.participants.index');
    // Route for adding one or more participants to an event.
    Route::post('/events/{event}/participants', [ParticipantController::class, 'store'])->name('events.participants.store');
    // Route for removing a participant from an event.
    Route::delete('/events/{event}/participants/{user}', [ParticipantController::class, 'destroy'])->name('events.participants.destroy');

    // -- Live Attendance Session Flow
    // Route for the Organizer to start the attendance session.
    Route::post('/events/{event}/start', [AttendanceSessionController::class, 'start'])->name('events.attendance.start');
    // The "Projector View" that displays the live QR code.
    Route::get('/events/{event}/live', [AttendanceSessionController::class, 'showLive'])->name('events.attendance.live');
    // Route for the Organizer to finish the attendance session.
    Route::post('/events/{event}/finish', [AttendanceSessionController::class, 'finish'])->name('events.attendance.finish');

    Route::get('/events/{event}/results', [AttendanceSessionController::class, 'showResults'])->name('events.attendance.results');

    Route::post('/events/{event}/refresh-token', [AttendanceSessionController::class, 'refreshToken'])->name('events.token.refresh');

    Route::get('/events/{event}/latest-token', [AttendanceSessionController::class, 'getLatestToken'])->name('events.token.latest');
    // A dedicated route to view the final attendance results/report after an event is finished.
    //Route::get('/events/{event}/results', [AttendanceSessionController::class, 'showResults'])->name('events.attendance.results');
    // AFTER
    Route::get('/attendance/scan', [AttendanceSessionController::class, 'scan'])->name('attendance.scan');
    // routes/web.php

// ... inside your Route::middleware('auth')->group(...)

// -- Route for the Participant's QR Code Scanner Tool
    Route::view('/scan', 'scan')->name('scan');

    // -- Participant Check-in Route
    // This is the endpoint the participant's mobile device will hit after scanning a QR code.
    //Route::post('/attendance/scan', [AttendanceSessionController::class, 'scan'])->name('attendance.scan');
});


// Public Utility Routes
// -------------------------------------------------------------------------

// -- QR Code Generator
// This route will generate and return the QR code image based on a token.
// The live view's JavaScript will update its <img> src to point to this route.
//Route::get('/qr-code-generator', [QrCodeController::class, 'generate'])->name('qr.generate');
