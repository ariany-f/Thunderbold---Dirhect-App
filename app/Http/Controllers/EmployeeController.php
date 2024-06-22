<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\CompanyBranch;
use App\Models\Tenant\CompanyBranchEmployee;
use App\Models\Tenant\CompanyGroup;
use App\Models\Tenant\Employee;
use App\Models\Tenant\Position;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = CompanyGroup::all();
        $branches = CompanyBranch::all();
        $users = User::role('employee')->get();
        $userIds = $users->pluck('id')->toArray();
        $positions = Position::all(); // Carrega todas as posições
        // Consultar os funcionários com base nos user_ids
        $employees = Employee::whereIn('user_id', $userIds)->get();
        return view('employee.create', compact('groups', 'branches', 'employees', 'positions'));
    }

    public function dependents($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $dependents = $employee->dependents; // Assumindo que a relação 'dependents' está definida no modelo Employee
        return view('employee.dependents', compact('employee', 'dependents'));
    }

    public function team($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $teamMembers = $employee->teamMembers;
        return view('employee.team', compact('employee', 'teamMembers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data_user = $request->all();
        $data_user['company_id'] = Auth::user()->company_id;
        $user = User::create($data_user);

        $data = $request->all();
        $data['user_id'] = $user->id;
        $data['manager'] = (isset($data['manager']) && $data['manager'] === 'on');
        if($data['manager'])
        {
            $user->assignRole('manager');
        }
        else
        {
            $user->assignRole('employee');
        }

        $employee = Employee::create($data);

        // Obter os IDs das filiais selecionadas do formulário
        $branchIds = $request->input('branch_id', []);

        // Vincular o Employee às filiais selecionadas
        foreach ($branchIds as $branchId) {
            // Criar o registro na tabela de junção
            CompanyBranchEmployee::create([
                'employee_id' => $employee->id,
                'branch_id' => $branchId,
            ]);
        }

        return redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);
        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::find($id);
        $groups = CompanyGroup::all();
        $branches = CompanyBranch::all();
        $users = User::role('employee')->get();
        $userIds = $users->pluck('id')->toArray();
        $positions = Position::all(); // Carrega todas as posições
        // Consultar os funcionários com base nos user_ids
        $employees = Employee::whereIn('user_id', $userIds)->get();
        return view('employee.edit', compact('employee','groups', 'branches', 'employees', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $data['manager'] = (isset($data['manager']) && $data['manager'] === 'on');
        
        $employee = Employee::find($id);
        if($data['manager'])
        {
            $user = User::where('email', $employee->email)->first();
            $user->assignRole('manager');
        }
        $employee->update($data);

        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        
        if (!$employee) {
            return redirect()->route('employee.index')->with('error', 'Employee not found.');
        }

        // Busca o usuário associado ao employee
        $user = User::where('email', $employee->email)->first();

        // Verifica se o usuário existe e o exclui
        if ($user) {
            $user->delete();
        }

        $employee->delete();

        return redirect()->route('employee.index');
    }
}
