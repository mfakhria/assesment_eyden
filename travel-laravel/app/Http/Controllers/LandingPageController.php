<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    public function __invoke(): View
    {
        $content = PageContent::query()
            ->pluck('content_value', 'content_key')
            ->toArray();

        return view('landing', compact('content'));
    }
}
