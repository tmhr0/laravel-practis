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
        $sections = $company->sections;

        return view('companies.sections.index', compact('sections', 'company'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Company $company): View
    {
        return view('companies.sections.create', compact('company'));
    }

    public function store(StoreSectionRequest $request,Company $company): RedirectResponse
    {
        $section = new Section();

        $section->create([
            'company_id' => $company->id,
            'name' => $request->name
        ]);
        return new RedirectResponse(route('companies.index'));
    }

    public function show(Company $company,Section $section): View
    {
        return view('companies.sections.show', compact('company','section'));
    }

    public function edit(Company $company,Section $section): View
    {
        return view('companies.sections.edit', compact( 'company','section'));
    }
    public function update(UpdateSectionRequest $request, Section $section): RedirectResponse
    {
        $section->fill($request->validated())
            ->save();

        return new RedirectResponse('companies.sections.index', compact('section'));
    }
}
