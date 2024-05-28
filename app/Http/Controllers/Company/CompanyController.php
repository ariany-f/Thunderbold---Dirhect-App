<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('company.index', compact('companies'));
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'main_color' => 'required'
        ]);

        $company = Company::create($request->all());

        $databaseName = "company{$company->id}";
        // Check if the database exists in MySQL
        $databaseExists = DB::select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?", [$databaseName]);

        // If the database doesn't exist, create it
        if (empty($databaseExists)) {
            DB::statement("CREATE DATABASE $databaseName");
        }

        $result = Artisan::call('tenant', [
            'instruction' => 'migrate:fresh --path=database/migrations/tenant --database=tenant',
            '--tenant' => $company->id,
        ]);

        return redirect()->route('company.index');
    }

    public function show(Company $company)
    {
        return view('company.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('company.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $company->update($request->all());
        return redirect()->route('company.index');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('company.index');
    }
}
