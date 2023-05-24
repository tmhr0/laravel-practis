<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Section;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SectionUserController extends Controller
{
    public function create(): View
    {

        return view('companies.sections.users.create');
    }
}
