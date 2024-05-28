<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Tenant\CompanyBranch;
use App\Models\Tenant\CompanyGroup;
use Illuminate\Http\Request;

class CompanyBranchController extends Controller
{
    public function index()
    {
        $branches = CompanyBranch::all();
        return view('company.branch.index', compact('branches'));
    }

    public function create()
    {
        $groups = CompanyGroup::all();
        return view('company.branch.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $company = CompanyBranch::create($request->all());

        return redirect()->route('company.branch.index');
    }

    public function show($branch)
    {
        $branch = CompanyBranch::find($branch);
        return view('company.branch.show', compact('branch'));
    }

    public function edit($branch)
    {
        $groups = CompanyGroup::all();
        $branch = CompanyBranch::find($branch);
        return view('company.branch.edit', compact('branch', 'groups'));
    }

    public function update(Request $request, $branch)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $branch = CompanyBranch::find($branch);
        $branch->update($request->all());
        return redirect()->route('company.branch.index');
    }

    public function destroy($branch)
    {
        $branch = CompanyBranch::find($branch);
        $branch->delete();
        return redirect()->route('company.branch.index');
    }
}
