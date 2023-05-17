<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $companies = Company::query()
            ->paginate()
            ->withQueryString();

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request): RedirectResponse
    {
        if ($request->action === 'back') {
            return redirect()->route('companies.index');
        } else {
            $company = new Company();
            $company->fill($request->validated())
                ->save();

            return redirect()->route('companies.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $company = Company::find($id);
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $company = Company::find($id);
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, $id): RedirectResponse
    {
        if($request->action === 'back') {
            return redirect()->route('companies.index');
        } else {
            $company = Company::find($id);
            $company->fill($request->validated())
            ->save();

        return redirect()->route('companies.index', compact('company'));
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $company = Company::find($id);
        $company->delete();

        return redirect()->route('companies.index', compact('company'));
    }
}
