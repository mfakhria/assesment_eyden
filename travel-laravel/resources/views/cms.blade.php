<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel CMS</title>
    @vite(['resources/js/app.jsx'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-[#f6f7fb] font-jakarta text-slate-900">
    @php
        $groups = [
            'Hero' => [
                'description' => 'Main headline, search card, and hero image assets.',
                'keys' => ['brand_name', 'eyebrow', 'hero_title', 'location', 'date', 'return_date', 'main_image', 'side_image'],
            ],
            'Navigation' => [
                'description' => 'Header menu labels shown on the landing page.',
                'keys' => ['nav_home', 'nav_tours', 'nav_reviews', 'nav_contact'],
            ],
            'Values Section' => [
                'description' => 'Content for the benefit cards below the hero.',
                'keys' => ['values_label', 'values_title', 'values_text', 'choice_title', 'choice_text', 'guide_title', 'guide_text', 'booking_title', 'booking_text'],
            ],
            'Decorative Assets' => [
                'description' => 'Optional icon paths used as landing decorations.',
                'keys' => ['camera_icon', 'plane_icon'],
            ],
        ];

        $contentByKey = $contents->keyBy('content_key');
        $mainImage = $contentByKey->get('main_image')?->content_value;
        $sideImage = $contentByKey->get('side_image')?->content_value;
    @endphp

    <main class="mx-auto max-w-7xl px-4 py-5 sm:px-6 lg:px-8">
        <section class="mb-5 overflow-hidden rounded-[2rem] bg-slate-950 text-white shadow-xl shadow-slate-200">
            <div class="grid gap-6 p-5 sm:p-6 lg:grid-cols-[1fr_360px] lg:p-8">
                <div class="flex flex-col justify-between gap-8">
                    <div>
                        <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-orange-300">Single Page CMS</p>
                        <h1 class="mt-3 text-3xl font-extrabold tracking-tight sm:text-4xl">Travel Landing Content</h1>
                        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-300">Edit konten landing page dari satu halaman. Field sudah dikelompokkan supaya lebih cepat dicari dan tidak perlu scroll panjang.</p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a class="rounded-full bg-orange-400 px-5 py-3 text-sm font-extrabold text-white shadow-lg shadow-orange-950/30 transition hover:-translate-y-0.5" href="{{ route('landing') }}">View Landing Page</a>
                        <a class="rounded-full border border-white/20 px-5 py-3 text-sm font-extrabold text-white transition hover:bg-white/10" href="#content-form">Edit Content</a>
                    </div>
                </div>

                <div class="rounded-[1.5rem] border border-white/10 bg-white/8 p-4">
                    <p class="mb-3 text-xs font-bold uppercase tracking-[0.14em] text-slate-400">Current Images</p>
                    <div class="grid grid-cols-2 gap-3">
                        @if ($mainImage)
                            <img class="h-40 rounded-[1.25rem] object-cover" src="{{ $mainImage }}" alt="Main hero preview">
                        @endif
                        @if ($sideImage)
                            <img class="h-40 rounded-[1.25rem] object-cover" src="{{ $sideImage }}" alt="Side hero preview">
                        @endif
                    </div>
                </div>
            </div>
        </section>

        @if (session('status'))
            <p class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-bold text-emerald-700">{{ session('status') }}</p>
        @endif

        @if ($errors->any())
            <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm font-bold text-red-700">Please fill all CMS fields before saving.</div>
        @endif

        <form id="content-form" method="POST" action="{{ route('cms.update') }}" class="grid gap-5 lg:grid-cols-[260px_1fr]">
            @csrf
            @method('PUT')

            <aside class="lg:sticky lg:top-5 lg:self-start">
                <div class="rounded-[1.5rem] bg-white p-3 shadow-sm ring-1 ring-slate-200/70">
                    <p class="px-3 pb-2 text-xs font-extrabold uppercase tracking-[0.14em] text-slate-400">Sections</p>
                    <div class="grid gap-2">
                        @foreach ($groups as $groupName => $group)
                            <a class="rounded-2xl px-3 py-3 text-sm font-extrabold text-slate-700 transition hover:bg-orange-50 hover:text-orange-500" href="#{{ str($groupName)->slug() }}">{{ $groupName }}</a>
                        @endforeach
                    </div>
                </div>
            </aside>

            <div class="grid gap-5">
                @foreach ($groups as $groupName => $group)
                    <section id="{{ str($groupName)->slug() }}" class="rounded-[1.75rem] bg-white p-4 shadow-sm ring-1 ring-slate-200/70 sm:p-5">
                        <div class="mb-4 flex flex-col justify-between gap-2 border-b border-slate-100 pb-4 sm:flex-row sm:items-end">
                            <div>
                                <h2 class="text-xl font-extrabold text-slate-950">{{ $groupName }}</h2>
                                <p class="mt-1 text-sm text-slate-500">{{ $group['description'] }}</p>
                            </div>
                            <span class="w-fit rounded-full bg-slate-100 px-3 py-1 text-xs font-extrabold text-slate-500">{{ count($group['keys']) }} fields</span>
                        </div>

                        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                            @foreach ($group['keys'] as $key)
                                @php $item = $contentByKey->get($key); @endphp

                                @if ($item)
                                    <label class="block rounded-2xl border border-slate-200 bg-slate-50/70 p-4 transition focus-within:border-orange-300 focus-within:bg-white focus-within:shadow-sm {{ in_array($key, ['hero_title', 'values_text', 'choice_text', 'guide_text', 'booking_text'], true) ? 'xl:col-span-2' : '' }}">
                                        <span class="mb-2 flex items-center justify-between gap-2 text-sm font-extrabold text-slate-700">
                                            <span>{{ str($item->content_key)->replace('_', ' ')->title() }}</span>
                                            <small class="rounded-full {{ $item->content_type === 'image' ? 'bg-sky-100 text-sky-700' : 'bg-orange-100 text-orange-700' }} px-2 py-1 text-[10px] uppercase">{{ $item->content_type }}</small>
                                        </span>

                                        @if ($item->content_type === 'image')
                                            <input name="contents[{{ $item->content_key }}]" value="{{ old("contents.$item->content_key", $item->content_value) }}" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-3 text-sm focus:border-orange-400 focus:outline-none" placeholder="/assets/images/example.webp">
                                        @else
                                            <textarea name="contents[{{ $item->content_key }}]" rows="{{ str($item->content_value)->length() > 55 ? 3 : 2 }}" class="w-full resize-y rounded-xl border border-slate-200 bg-white px-3 py-3 text-sm leading-6 focus:border-orange-400 focus:outline-none">{{ old("contents.$item->content_key", $item->content_value) }}</textarea>
                                        @endif
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    </section>
                @endforeach

                <div class="sticky bottom-4 z-20 rounded-[1.5rem] border border-slate-200 bg-white/90 p-3 shadow-2xl shadow-slate-300/40 backdrop-blur">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm font-bold text-slate-500">Review perubahan, lalu simpan semua field sekaligus.</p>
                        <button class="rounded-full bg-orange-400 px-7 py-3 text-sm font-extrabold text-white shadow-lg shadow-orange-200 transition hover:-translate-y-0.5" type="submit">Save Content</button>
                    </div>
                </div>
            </div>
        </form>
    </main>
</body>
</html>
