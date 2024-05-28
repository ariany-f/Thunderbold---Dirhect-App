<?php

use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\CompanyBranchController;
use App\Http\Controllers\Company\CompanyGroupController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::middleware('auth')->group(function () {

    Route::get('/company/branch', [CompanyBranchController::class, 'index'])->name('company.branch.index');
    Route::get('/company/branch/create', [CompanyBranchController::class, 'create'])->name('company.branch.create');
    Route::post('/company/branch', [CompanyBranchController::class, 'store'])->name('company.branch.store');
    Route::get('/company/branch/{branch}', [CompanyBranchController::class, 'show'])->name('company.branch.show');
    Route::get('/company/branch/{branch}/edit', [CompanyBranchController::class, 'edit'])->name('company.branch.edit');
    Route::put('/company/branch/{branch}', [CompanyBranchController::class, 'update'])->name('company.branch.update');
    Route::delete('/company/branch/{branch}', [CompanyBranchController::class, 'destroy'])->name('company.branch.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/company/group', [CompanyGroupController::class, 'index'])->name('company.group.index');
    Route::get('/company/group/create', [CompanyGroupController::class, 'create'])->name('company.group.create');
    Route::post('/company/group', [CompanyGroupController::class, 'store'])->name('company.group.store');
    Route::get('/company/group/{group}', [CompanyGroupController::class, 'show'])->name('company.group.show');
    Route::get('/company/group/{group}/edit', [CompanyGroupController::class, 'edit'])->name('company.group.edit');
    Route::put('/company/group/{group}', [CompanyGroupController::class, 'update'])->name('company.group.update');
    Route::delete('/company/group/{group}', [CompanyGroupController::class, 'destroy'])->name('company.group.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::resource('user', UserController::class)->middleware('auth');

Route::resource('employee', EmployeeController::class)->middleware('auth');

Route::resource('company', CompanyController::class)->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');;
});

require __DIR__.'/auth.php';
