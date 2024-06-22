<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\CompanyBranchController;
use App\Http\Controllers\Company\CompanyGroupController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DependentController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');;

    Route::get('/company/group', [CompanyGroupController::class, 'index'])->name('company.group.index');
    Route::get('/company/group/create', [CompanyGroupController::class, 'create'])->name('company.group.create');
    Route::post('/company/group', [CompanyGroupController::class, 'store'])->name('company.group.store');
    Route::get('/company/group/{group}', [CompanyGroupController::class, 'show'])->name('company.group.show');
    Route::get('/company/group/{group}/edit', [CompanyGroupController::class, 'edit'])->name('company.group.edit');
    Route::put('/company/group/{group}', [CompanyGroupController::class, 'update'])->name('company.group.update');
    Route::delete('/company/group/{group}', [CompanyGroupController::class, 'destroy'])->name('company.group.destroy');

    Route::get('/company/branch', [CompanyBranchController::class, 'index'])->name('company.branch.index');
    Route::get('/company/branch/create', [CompanyBranchController::class, 'create'])->name('company.branch.create');
    Route::post('/company/branch', [CompanyBranchController::class, 'store'])->name('company.branch.store');
    Route::get('/company/branch/{branch}', [CompanyBranchController::class, 'show'])->name('company.branch.show');
    Route::get('/company/branch/{branch}/edit', [CompanyBranchController::class, 'edit'])->name('company.branch.edit');
    Route::put('/company/branch/{branch}', [CompanyBranchController::class, 'update'])->name('company.branch.update');
    Route::delete('/company/branch/{branch}', [CompanyBranchController::class, 'destroy'])->name('company.branch.destroy');

    Route::resource('company', CompanyController::class);

    Route::resource('dependents', DependentController::class);
    Route::resource('team', TeamController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('user', UserController::class);

    Route::get('employees/{employee}/dependents', [EmployeeController::class, 'dependents'])->name('employee.dependents');
    Route::get('employees/{employee}/team', [EmployeeController::class, 'team'])->name('employee.team');
    Route::get('employees/{employee_id}/dependents/create', [DependentController::class, 'create'])->name('dependents.create');
    Route::get('employees/{employee_id}/team/create', [TeamController::class, 'create'])->name('team.create');
    Route::delete('team/{member_id}/{employee_id}', [TeamController::class, 'destroy'])->name('team.destroy');

    Route::get('positions', [PositionController::class, 'index'])->name('positions.index');
    Route::get('positions/create', [PositionController::class, 'create'])->name('positions.create');
    Route::post('positions', [PositionController::class, 'store'])->name('positions.store');
    Route::get('positions/{position}', [PositionController::class, 'show'])->name('positions.show');
    Route::get('positions/{position}/edit', [PositionController::class, 'edit'])->name('positions.edit');
    Route::put('positions/{position}', [PositionController::class, 'update'])->name('positions.update');
    Route::delete('positions/{position}', [PositionController::class, 'destroy'])->name('positions.destroy');
});
