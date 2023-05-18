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
            $company = new Company();
            $company->fill($request->validated())
                ->save();

            return redirect()->route('companies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $Company): View
    {
//        return view('companies.show', compact('company'));
        return view('companies.show', ['company' => Company::findOrFail($Company)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $Company): View
    {
        return view('companies.edit', ['company' => Company::findOrFail($Company)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, string $Company): RedirectResponse
    {
        $company = Company::find($Company);
        $company->fill($request->validated())
            ->save();

        return redirect()->route('companies.index', compact('company'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $Company): RedirectResponse
    {
        $company = Company::find($Company);
        $company->delete();

        return redirect()->route('companies.index', compact('company'));
    }
}
