<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectionUserRequest;
use App\Models\Company;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SectionUserController extends Controller
{
    public function store(StoreSectionUserRequest $request, Company $company, Section $section): RedirectResponse
    {

        $section->users()->attach($request->user_id);

        $company = $section->company;

        return redirect()->route('sections.show', compact('company', 'section'));
    }
    public function destroy(Company $company, Section $section, User $user)
    {
        $section->users()->detach($user->id);

        $company = $section->company;

        return redirect()->route('sections.show', compact('company', 'section'));
    }
}
