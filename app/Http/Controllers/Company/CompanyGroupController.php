<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Tenant\CompanyGroup;
use Illuminate\Http\Request;

class CompanyGroupController extends Controller
{
    public function index()
    {
        $groups = CompanyGroup::all();
        return view('company.group.index', compact('groups'));
    }

    public function create()
    {
        return view('company.group.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $group = CompanyGroup::create($request->all());

        return redirect()->route('company.group.index');
    }

    public function show($group)
    {
        $group = CompanyGroup::find($group);
        return view('company.group.show', compact('group'));
    }

    public function edit($group)
    {
        $group = CompanyGroup::find($group);
        return view('company.group.edit', compact('group'));
    }

    public function update(Request $request, $group)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $group = CompanyGroup::find($group);
        $group->update($request->all());
        return redirect()->route('company.group.index');
    }

    public function destroy(CompanyGroup $group)
    {
        $group->delete();
        return redirect()->route('company.group.index');
    }
}
