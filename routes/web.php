<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacientsController;
use App\Http\Controllers\PacientController;
use App\Http\Controllers\UchastokController;
use App\Http\Controllers\RoddomController;
use App\Http\Controllers\VacinesConroller;
use App\Http\Controllers\BolezniController;
use App\Http\Controllers\StacionarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Filters\pacientsFilter;
use GuzzleHttp\Middleware;

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

Route::get('/', [AuthController::class, 'AuthPage'])->name('AuthPage');
Route::post('/tryAutorization', [AuthController::class, 'TryAuth'])->name('TryAuth');
Route::get('/logout', [AuthController::class, 'Logout'])->name('Logout');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/uchastki', [UchastokController::class, 'UchastkiPage'])->name('UchastkiPage');
    Route::get('/uchastki1',[DataController::class, 'uchastki']);
    Route::get('/stacionars', [StacionarController::class, 'StacionarsPage'])->name('StacionarsPage');
    Route::get('/roddoms', [RoddomController::class, 'RoddomsPage'])->name('RoddomsPage');
    Route::get('/vacines', [VacinesConroller::class, 'VacinesPage'])->name('VacinesPage');
    Route::get('/bolezni', [BolezniController::class, 'BolezniPage'])->name('BolezniPage');
    Route::get('/pacients/del/{id}', [PacientsController::class, 'DeletePacient'])->name('DeletePacient');
    Route::get('/roddoms/del/{id}', [RoddomController::class, 'DeleteRoddom'])->name('DeleteRoddom');
    Route::get('/uchastki/del/{id}', [UchastokController::class, 'DeleteUchastok'])->name('DeleteUchastok');
    Route::get('/bolezni/del/{id}', [BolezniController::class, 'DeleteBolezn'])->name('DeleteBolezn');
    Route::get('/vacines/del/{id}', [VacinesConroller::class, 'DeleteVacine'])->name('DeleteVacine');
    Route::get('/staciionars/del/{id}', [StacionarController::class, 'DeleteStacionar'])->name('DeleteStacionar');
    Route::get('/pacient', [PacientsController::class, 'PacientsPage'])->name('PacientsPage');
});

Route::post('pacient/sort_by_lastname', [PacientsController::class, 'PacientsSortByLastnamme'])->name('PacientsSortByLastnamme');
Route::get('/pacient/{id}', [PacientController::class, 'PacientPage'])->name('OnePacientPage')->middleware(['auth', 'availability']);


Route::post('/pacients/add', [PacientsController::class, 'AddPacient'])->name('AddPacient');
Route::post('/uchastki/add', [UchastokController::class, 'AddUchastok'])->name('AddUchastok');
Route::post('/roddoms/add', [RoddomController::class, 'AddRoddom'])->name('AddRoddom');
Route::post('/bolezni/add', [BolezniController::class, 'AddBolezn'])->name('AddBolezn');
Route::post('/vacines/add', [VacinesConroller::class, 'AddVacine'])->name('AddVacine');
Route::post('/staciionars/add', [StacionarController::class, 'AddStacionar'])->name('AddStacionar');

Route::post('/pacients/upd/{id}', [PacientsController::class, 'UpdatePacient'])->name('UpdatePacient')->middleware('availability');
Route::post('/uchastki/upd/{id}', [UchastokController::class, 'UpdateUchastok'])->name('UpdateUchastok');
Route::post('/roddoms/upd/{id}', [RoddomController::class, 'UpdateRoddom'])->name('UpdateRoddom');
Route::post('/bolezni/upd/{id}', [BolezniController::class, 'UpdateBolezn'])->name('UpdateBolezn');
Route::post('/vacines/upd/{id}', [VacinesConroller::class, 'UpdateVacine'])->name('UpdateVacine');
Route::post('/staciionars/upd/{id}', [StacionarController::class, 'UpdateStacionar'])->name('UpdateStacionar');



Route::post('/pacient/{id}/saveAll', [PacientController::class, 'saveAll'])->name('saveAll')->middleware('availability');
Route::post('/pacient/{id}/addPacientToStacionar', [PacientController::class, 'addPacientToStacionar'])->name('addPacientToStacionar')->middleware('availability');;
Route::post('/updatePacientStacionar/{id}', [PacientController::class, 'updatePacientStacionar'])->name('updatePacientStacionar')->middleware('availability');;
Route::get('/deletePacientStacionar/{id}', [PacientController::class, 'deletePacientStacionar'])->name('deletePacientStacionar')->middleware('availability');;