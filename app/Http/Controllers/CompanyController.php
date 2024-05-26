<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
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

        return redirect()->route('companies.index');
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $company->update($request->all());
        return redirect()->route('companies.index');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index');
    }
}
