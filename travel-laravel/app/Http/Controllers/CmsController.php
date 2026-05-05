<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CmsController extends Controller
{
    public function edit(): View
    {
        $contents = PageContent::query()->orderBy('id')->get();

        return view('cms', compact('contents'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'contents' => ['required', 'array'],
            'contents.*' => ['required', 'string'],
        ]);

        foreach ($validated['contents'] as $key => $value) {
            PageContent::where('content_key', $key)->update(['content_value' => $value]);
        }

        return back()->with('status', 'Content updated successfully.');
    }
}
