<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DBBackupController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PoolingController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\UdaraController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::permanentRedirect('/', '/login');

Auth::routes();

Route::get('/sampah/chart-data', [SampahController::class, 'fetchChartData']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('profil', ProfilController::class)->except('destroy');


Route::get('/barChart', [SampahController::class, 'chart'])->name('barChart');
Route::get('/barChart', [MonitoringController::class, 'chart'])->name('barChart');


Route::resource('monitoring', MonitoringController::class);
Route::resource('pooling', PoolingController::class);
Route::resource('dashboard', DashboardController::class);

Route::resource('sampah', SampahController::class);
Route::resource('udara', UdaraController::class);


Route::resource('manage-user', UserController::class);
Route::resource('manage-role', RoleController::class);
Route::resource('manage-menu', MenuController::class);
Route::resource('manage-permission', PermissionController::class)->only('store', 'destroy');


Route::get('dbbackup', [DBBackupController::class, 'DBDataBackup']);

//Route::get('/chart', [UdaraController::class])->name('udara.index');

