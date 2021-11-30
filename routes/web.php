<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AntennaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CoordinateController;
use App\Http\Controllers\LiveFeedController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\NotificationsController;
use App\Events\LiveFeedUpdate;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('antennas', AntennaController::class);
Route::resource('notifications', NotificationsController::class);
Route::resource('users', UserController::class);
Route::resource('vehicles', VehicleController::class);
Route::resource('tags', TagController::class);
Route::resource('coordinates', CoordinateController::class);
Route::resource('livefeed', LiveFeedController::class);
Route::resource('reports', ReportsController::class);

/*
Route::resource('antennas', AntennaController::class);
Route::resource('users', UserController::class);*/

/**
 * Everytime I make a request to /map it calls the method 'markers' which retrieves de Latitude and Longitude for the location of the Antennas
 * Only showing the ones marked as Active
 */

//Route::get('/map', [PageController::class, 'markers']); FUNCIONA, TRAE LOS LOCATIONS A MARCAR EN MAPA
Route::get('/map', [LiveFeedController::class, 'dataLocation']);
Route::get('/live', [PageController::class, 'livedata']);
Route::get('/antennasmap', [PageController::class, 'mapAntenna']);
Route::get('/alertsReport', [ReportsController::class, 'index']);

Route::get('/mapAntenna', function () {
    return view('antennas.map');
})->name('antennas.map');

Route::get('/adminReports', function () {
    return view('reports.admin');
})->name('reports.admin');

Route::get('/live/data', [LiveFeedController::class, 'data']);

Route::get('/unreadNotifications', [NotificationsController::class, 'unreadNotifications']);

Route::post('/updateNotifications', [NotificationsController::class, 'updateNotifications']);
