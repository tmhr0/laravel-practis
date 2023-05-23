<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectionRequest;
use App\Models\Company;
use App\Models\Section;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use phpDocumentor\Reflection\Types\Collection;

class SectionController extends Controller
{
    public function index(Company $company): View
    {
        $sections = $company->sections();

        $company = Company::find($company);

        return view('companies.sections.index', compact('sections', 'company'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Company $company): View
    {
        $company = Company::findOrFail($company);

        return view('companies.sections.create', compact('company'));

    }

    public function store(StoreSectionRequest $request,Company $company): RedirectResponse
    {
        $section = new Section();
        $company = Company::findOrFail($company);

        $section->create([
            'company_id' => $company->id,
            'name' => $request->name
        ]);

        return new RedirectResponse(route('companies.index'));
    }

    public function show(Section $section, Company $company): View
    {
        $section = $company->sections()->findOrFail($section->id);

        return view('companies.sections.show', compact('section', 'company'));
    }

    public function edit(Section $section, Company $company): View
    {
        $company = Company::findOrFail($company);
        $section = Section::findOrFail($section);

        return view('companies.sections.edit', compact('section', 'company'));
    }
}
