<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use App\Support\FallbackPageContent;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CmsController extends Controller
{
    public function edit(): View
    {
        try {
            $contents = PageContent::query()->orderBy('id')->get();
            $databaseOffline = false;
        } catch (QueryException) {
            $contents = collect(FallbackPageContent::all())->map(function (string $value, string $key): object {
                return (object) [
                    'content_key' => $key,
                    'content_type' => str_contains($key, 'image') || str_contains($key, 'icon') ? 'image' : 'text',
                    'content_value' => $value,
                ];
            })->values();
            $databaseOffline = true;
        }

        return view('cms', compact('contents', 'databaseOffline'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'contents' => ['required', 'array'],
            'contents.*' => ['required', 'string'],
        ]);

        try {
            foreach ($validated['contents'] as $key => $value) {
                PageContent::where('content_key', $key)->update(['content_value' => $value]);
            }
        } catch (QueryException) {
            return back()->with('error', 'Database belum terkoneksi. Jalankan MySQL terlebih dahulu sebelum menyimpan CMS.');
        }

        return back()->with('status', 'Content updated successfully.');
    }
}
