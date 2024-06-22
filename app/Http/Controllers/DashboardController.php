<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardCOntroller extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $next30Days = $today->copy()->addDays(30);
        if ($user->hasRole('admin')) {
            // Buscar aniversários de todos os funcionários da empresa
            $upcomingBirthdays = Employee::all()->filter(function ($employee) use ($today, $next30Days) {
                $birthdate = Carbon::parse($employee->birthdate);
                $birthdayThisYear = Carbon::createFromDate(null, $birthdate->month, $birthdate->day);
                return $birthdayThisYear->between($today, $next30Days);
            })->sortBy(function ($employee) {
                $birthdate = Carbon::parse($employee->birthdate);
                return Carbon::createFromDate(null, $birthdate->month, $birthdate->day)->dayOfYear;
            });
        
        } elseif ($user->hasRole('Super-Admin')) {
            $upcomingBirthdays = collect();
        } elseif ($user->employee && $user->employee->manager) {
            // Buscar aniversários dos membros da equipe do gerente
            $teamMembers = $user->employee->teamMembers;
            $upcomingBirthdays = $teamMembers->filter(function ($member) use ($today, $next30Days) {
                $birthdate = Carbon::parse($member->birthdate);
                $birthdayThisYear = Carbon::createFromDate(null, $birthdate->month, $birthdate->day);
                return $birthdayThisYear->between($today, $next30Days);
            })->sortBy(function ($member) {
                $birthdate = Carbon::parse($member->birthdate);
                return Carbon::createFromDate(null, $birthdate->month, $birthdate->day)->dayOfYear;
            });
        } else {
            $upcomingBirthdays = collect();
        }

        return view('dashboard', compact('upcomingBirthdays'));
    }
}
