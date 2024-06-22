<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\Dependent;
use App\Models\Tenant\Employee;
use Illuminate\Http\Request;

class DependentController extends Controller
{
    public function index()
    {
         // Obtém o usuário autenticado
        $user = Auth::user();

        // Carrega o employee associado a este usuário
        $employee = $user->employee;
        
        // Verifica se o employee existe e carrega os dependentes associados a ele
        if ($employee) {
            $dependents = $employee->dependents;
        } else {
            $dependents = collect(); // Retorna uma coleção vazia se não houver employee associado
        }
    
        return view('dependents.index', compact('employee', 'dependents'));
    }

    public function create($employee_id)
    {
        $employee = Employee::findOrFail($employee_id);
        return view('dependents.create', compact('employee'));
    }

    public function store(Request $request)
    {
        $dependent = Dependent::create($request->all());

        return redirect()->route('employee.dependents', $dependent->employee_id)->with('success', 'Dependent created successfully.');
    }

    public function show($id)
    {
        $dependent = Dependent::findOrFail($id);
        return view('dependents.show', compact('dependent'));
    }

    public function edit($id)
    {
        $dependent = Dependent::findOrFail($id);
        return view('dependents.edit', compact('dependent'));
    }

    public function update(Request $request, $id)
    {
        $dependent = Dependent::findOrFail($id);
        $dependent->update($request->all());

        return redirect()->route('employee.dependents', $dependent->employee_id)->with('success', 'Dependent updated successfully.');
    }

    public function destroy($id)
    {
        $dependent = Dependent::findOrFail($id);
        $dependent->delete();

        // Redirect to dependents of the associated employee
        return redirect()->route('employee.dependents', $dependent->employee_id)->with('success', 'Dependent deleted successfully.');
    }
}
