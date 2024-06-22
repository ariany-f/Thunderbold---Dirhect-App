<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Tenant\Employee;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        
        // Obtém o usuário autenticado
        $user = Auth::user();

        // Carrega o employee associado a este usuário
        $employee = $user->employee;
        
        // Verifica se o employee existe e carrega os dependentes ou membros da equipe associados a ele
        if ($employee) {
           
            // Se for um manager, carrega os membros da equipe (teamMembers)
            $teamMembers = $employee->teamMembers;
        } else {
            // Lógica para lidar com usuário sem employee associado (se necessário)
        }

        return view('team.index', compact('teamMembers', 'employees', 'employee'));
    }

    public function create($employee_id)
    {
        $employee = Employee::findOrFail($employee_id);
        // Obtenha os IDs dos empregados que já fazem parte do time do gerente
        $existingTeamMemberIds = $employee->teamMembers->pluck('id')->toArray();
        $employees = Employee::where('id', '!=', $employee_id)
        ->whereNotIn('id', $existingTeamMemberIds)
        ->get();
        return view('team.create', compact('employees', 'employee'));
    }

    public function store(Request $request)
    {
        // Atualize os membros da equipe do usuário
        $employee = Employee::find($request->manager_id);
        
        // Busca o usuário associado ao employee
        $user = User::where('email', $employee->email)->first();

        // Verifica se o usuário existe e remove o membro da equipe
        if ($user) {
            $user->employee->teamMembers()->attach($request->employee_id);
        }
    
        return redirect()->route('employee.team', $employee->id)->with('success', 'Employee added to your team.');
    }

    public function destroy($member_id, $employee_id)
    {
        // Atualize os membros da equipe do usuário autenticado
        $employee = Employee::find($employee_id);

        // Busca o usuário associado ao employee
        $user = User::where('email', $employee->email)->first();

        // Verifica se o usuário existe e remove o membro da equipe
        if ($user) {
            $user->employee->teamMembers()->detach($member_id);
        }

        return redirect()->route('employee.team', $employee_id)->with('success', 'Employee removed from your team.');
    }
}