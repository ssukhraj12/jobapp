<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\JobcatController;
use App\Http\Controllers\JobtypeController;
use App\Http\Controllers\JobController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/locations/countries', [LocationController::class, 'listCountries'])->name('list.countries');
Route::get('/locations/states', [LocationController::class, 'listStates'])->name('list.states');
Route::get('/locations/cities', [LocationController::class, 'listCities'])->name('list.cities');
Route::get('/admin/jobcats', [JobcatController::class, 'jobcatView'])->name('admin.jobcats');
Route::get('/admin/jobtypes', [JobtypeController::class, 'jobtypeView'])->name('admin.jobtype');
Route::get('/admin/jobs', [JobController::class, 'jobsView'])->name('admin.jobs');


//json Routs
Route::get('countries',[LocationController::class,'countries'])->name('api..countries');
Route::get('states',[LocationController::class,'states'])->name('api.states');
Route::get('cities',[LocationController::class,'cities'])->name('api.cities');
Route::get('/api/jobcats',[JobcatController::class,'allJobcats'])->name('api.jobcats');
Route::post('/api/jobcat/add',[JobcatController::class,'addJobcat'])->name('api.addjobcat');
Route::get('api/jobtypes',[JobtypeController::class,'allJobtypes'])->name('api.jobtypes');
Route::post('api/jobtype/add',[JobtypeController::class,'addJobtype'])->name('api.addjobtype');

