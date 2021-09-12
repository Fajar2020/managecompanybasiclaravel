<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;


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
    return view('guest');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin', function () {
        return view('content.index');
    })->name('admindashboard');

    Route::prefix('company')->group(function(){
        Route::get('/view', [CompanyController::class, 'allActiveCompanies'])->name('all.company');
        Route::get('/add', [CompanyController::class, 'addCompany'])->name('add.company');
        Route::post('/store', [CompanyController::class, 'storeCompany'])->name('store.company');
        Route::get('/edit/{id}', [CompanyController::class, 'editCompany'])->name('company.edit');
        Route::post('/update', [CompanyController::class, 'updateCompany'])->name('company.update');
        Route::get('/delete/{id}', [CompanyController::class, 'softDeleteCompany'])->name('company.softdelete');
        Route::get('/recycle/view', [CompanyController::class, 'allSoftDelCompanies'])->name('reycle.all.company');
        Route::get('/restore/{id}', [CompanyController::class, 'restoreCompany']);
        Route::get('/pdelete/{id}', [CompanyController::class, 'forceDeleteCompany']);
    });
    
    
    Route::prefix('employee')->group(function(){
        Route::get('/view', [EmployeeController::class, 'allActiveEmployees'])->name('all.employee');
        Route::get('/add', [EmployeeController::class, 'addEmployee'])->name('add.employee');
        Route::post('/store', [EmployeeController::class, 'storeEmployee'])->name('store.employee');
        Route::get('/edit/{id}', [EmployeeController::class, 'editEmployee'])->name('employee.edit');
        Route::post('/update', [EmployeeController::class, 'updateEmployee'])->name('employee.update');
        Route::get('/delete/{id}', [EmployeeController::class, 'softDeleteEmployee'])->name('employee.softdelete');
        Route::get('/recycle/view', [EmployeeController::class, 'allSoftDelEmployees'])->name('reycle.all.employee');
        Route::get('/restore/{id}', [EmployeeController::class, 'restoreEmployee']);
        Route::get('/pdelete/{id}', [EmployeeController::class, 'forceDeleteEmployee']);
    });

    Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');
});

