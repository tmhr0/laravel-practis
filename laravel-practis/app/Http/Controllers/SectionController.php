<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Models\Company;
use App\Models\Section;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SectionController extends Controller
{
    public function index(Company $company): View
    {
        $this->authorize('index', [Section::class, $company]);
        $sections = $company->sections;

        return view('companies.sections.index', compact('sections', 'company'));
    }

    public function create(Company $company): View
    {
        $this->authorize('create', [Section::class, $company]);
        return view('companies.sections.create', compact('company'));
    }

    public function store(StoreSectionRequest $request, Company $company): RedirectResponse
    {
        $this->authorize('store', [Section::class, $company]);
        $section = new Section();

        $section->create([
            'company_id' => $company->id,
            'name' => $request->name
        ]);
        return new RedirectResponse(route('companies.index'));
    }

    public function show(Company $company, Section $section): View
    {
        $this->authorize('show', [Section::class, $company]);
        $users = $company->users;
        return view('companies.sections.show', compact('company', 'section'));
    }

    public function edit(Company $company, Section $section): View
    {
        $this->authorize('edit', [Section::class, $company]);
        return view('companies.sections.edit', compact('company', 'section'));
    }

    public function update(UpdateSectionRequest $request, Company $company, Section $section): RedirectResponse
    {
        $this->authorize('update', [Section::class, $company]);
        $section->fill($request->validated())
            ->save();

        return redirect()->route('sections.index', compact('company', 'section'));
    }
}
