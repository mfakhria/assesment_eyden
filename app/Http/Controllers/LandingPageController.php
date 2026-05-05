<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use App\Support\FallbackPageContent;
use Illuminate\Database\QueryException;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    public function __invoke(): View
    {
        try {
            $content = PageContent::query()
                ->pluck('content_value', 'content_key')
                ->toArray();
            $databaseOffline = false;
        } catch (QueryException) {
            $content = FallbackPageContent::all();
            $databaseOffline = true;
        }

        return view('landing', compact('content', 'databaseOffline'));
    }
}
