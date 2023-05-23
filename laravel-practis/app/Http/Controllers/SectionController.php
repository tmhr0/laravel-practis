<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectionRequest;
use App\Models\Company;
use App\Models\Section;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SectionController extends Controller
{
    public function index($id): View
    {
        $sections = Section::query()
            ->paginate()
            ->withQueryString();

        $company = Company::find($id);

        return view('companies.sections.index', compact('sections', 'company'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $id): View
    {
        $company = Company::findOrFail($id);

        return view('companies.sections.create', compact('company'));

    }

    public function store(StoreSectionRequest $request, $company): RedirectResponse
    {
        $section = new Section();
        $company = Company::findOrFail($company);

        $section->create([
            'company_id' => $company->id,
            'name' => $request->name
        ]);

        return new RedirectResponse(route('companies.index'));
    }

    public function show($section): View
    {
        $section = Section::findOrFail($section);

        return view('companies.sections.show', compact('section'));

    }


    public function edit(Section $section): View
    {
        $section = Section::findOrFail($section);

        return view('companies.sections.show', compact('section'));
    }
}
