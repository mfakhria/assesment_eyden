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
        $value = fn ($key) => old("contents.$key", $contentByKey->get($key)?->content_value ?? '');
        $mainImage = $value('main_image');
        $sideImage = $value('side_image');
    @endphp

    <main class="mx-auto max-w-7xl px-3 py-3 sm:px-6 sm:py-5 lg:px-8">
        <section class="mb-4 overflow-hidden rounded-[1.5rem] bg-slate-950 text-white shadow-xl shadow-slate-200 sm:mb-5 sm:rounded-[2rem]">
            <div class="grid gap-5 p-4 sm:gap-6 sm:p-6 lg:grid-cols-[1fr_360px] lg:p-8">
                <div class="flex flex-col justify-between gap-8">
                    <div>
                        <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-orange-300">Single Page CMS</p>
                        <h1 class="mt-3 text-2xl font-extrabold tracking-tight sm:text-4xl">Travel Landing Content</h1>
                        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-300">Edit konten landing page dari satu halaman. Field sudah dikelompokkan supaya lebih cepat dicari dan tidak perlu scroll panjang.</p>
                    </div>

                    <div class="grid gap-3 sm:flex sm:flex-wrap">
                        <a class="rounded-full bg-orange-400 px-5 py-3 text-center text-sm font-extrabold text-white shadow-lg shadow-orange-950/30 transition hover:-translate-y-0.5" href="{{ route('landing') }}">View Landing Page</a>
                        <a class="rounded-full border border-white/20 px-5 py-3 text-center text-sm font-extrabold text-white transition hover:bg-white/10" href="#content-form">Edit Content</a>
                    </div>
                </div>

                <div class="rounded-[1.25rem] border border-white/10 bg-white/8 p-3 sm:rounded-[1.5rem] sm:p-4">
                    <p class="mb-3 text-xs font-bold uppercase tracking-[0.14em] text-slate-400">Current Images</p>
                    <div class="grid grid-cols-2 gap-3">
                        @if ($mainImage)
                            <img class="h-28 w-full rounded-[1rem] object-cover sm:h-40 sm:rounded-[1.25rem]" src="{{ $mainImage }}" alt="Main hero preview">
                        @endif
                        @if ($sideImage)
                            <img class="h-28 w-full rounded-[1rem] object-cover sm:h-40 sm:rounded-[1.25rem]" src="{{ $sideImage }}" alt="Side hero preview">
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

        <form id="content-form" method="POST" action="{{ route('cms.update') }}" class="grid gap-4 lg:grid-cols-[260px_1fr] lg:gap-5">
            @csrf
            @method('PUT')

            <aside class="sticky top-0 z-30 -mx-3 bg-[#f6f7fb]/95 px-3 py-2 backdrop-blur sm:mx-0 sm:px-0 lg:top-5 lg:self-start lg:bg-transparent lg:py-0 lg:backdrop-blur-0">
                <div class="rounded-[1.25rem] bg-white p-3 shadow-sm ring-1 ring-slate-200/70 lg:rounded-[1.5rem]">
                    <p class="px-1 pb-2 text-xs font-extrabold uppercase tracking-[0.14em] text-slate-400 sm:px-3">Sections</p>
                    <div class="flex gap-2 overflow-x-auto pb-1 lg:grid lg:overflow-visible lg:pb-0">
                        @foreach ($groups as $groupName => $group)
                            <button class="cms-section-tab shrink-0 rounded-2xl px-4 py-3 text-left text-sm font-extrabold transition lg:w-full {{ $loop->first ? 'bg-orange-400 text-white hover:bg-orange-400 hover:text-white' : 'text-slate-700 hover:bg-orange-50 hover:text-orange-500' }}" type="button" data-section-target="{{ str($groupName)->slug() }}">{{ $groupName }}</button>
                        @endforeach
                    </div>
                </div>
            </aside>

            <div class="grid gap-5">
                @foreach ($groups as $groupName => $group)
                    <section id="{{ str($groupName)->slug() }}" class="cms-section-panel rounded-[1.35rem] bg-white p-3 shadow-sm ring-1 ring-slate-200/70 sm:rounded-[1.75rem] sm:p-5 {{ ! $loop->first ? 'hidden' : '' }}" data-section-panel="{{ str($groupName)->slug() }}">
                        <div class="mb-4 flex flex-col justify-between gap-2 border-b border-slate-100 pb-4 sm:flex-row sm:items-end">
                            <div>
                                <h2 class="text-xl font-extrabold text-slate-950">{{ $groupName }}</h2>
                                <p class="mt-1 text-sm text-slate-500">{{ $group['description'] }}</p>
                            </div>
                            <span class="w-fit rounded-full bg-slate-100 px-3 py-1 text-xs font-extrabold text-slate-500">{{ count($group['keys']) }} fields</span>
                        </div>

                        <div class="grid gap-4 xl:grid-cols-[280px_1fr] xl:gap-5">
                            <details class="rounded-[1.25rem] border border-orange-100 bg-orange-50/50 p-3 open:p-3 sm:rounded-[1.5rem] sm:p-4 sm:open:p-4 xl:block" open>
                                <summary class="flex cursor-pointer list-none items-center justify-between text-xs font-extrabold uppercase tracking-[0.14em] text-orange-500 xl:pointer-events-none">
                                    <span>Landing Preview</span>
                                    <span class="text-[10px] text-orange-400 xl:hidden">Tap</span>
                                </summary>
                                <div class="mt-3">
                                @if ($groupName === 'Hero')
                                    <div class="overflow-hidden rounded-2xl bg-white p-4 shadow-sm">
                                        <div class="mb-4 flex items-center justify-between text-xs font-extrabold">
                                            <span class="flex items-center gap-1"><span class="grid h-5 w-5 place-items-center rounded-full bg-orange-400 text-white">T</span><span data-preview="brand_name">{{ $value('brand_name') }}</span></span>
                                            <span class="rounded-full border border-slate-200 px-3 py-1">Search</span>
                                        </div>
                                        <p class="text-xs font-semibold text-slate-500" data-preview="eyebrow">{{ $value('eyebrow') }}</p>
                                        <h3 class="mt-2 font-playfair text-3xl font-black leading-[0.95] text-slate-950">Life is short<br>and the world 🌍<br>is Wide! 🏝️</h3>
                                        <div class="mt-4 grid grid-cols-2 gap-2">
                                            <img class="h-28 rounded-t-full rounded-b-[3rem] object-cover" data-preview-src="main_image" src="{{ $value('main_image') }}" alt="Main image preview">
                                            <img class="mt-8 h-20 rounded-t-full rounded-b-[2rem] object-cover" data-preview-src="side_image" src="{{ $value('side_image') }}" alt="Side image preview">
                                        </div>
                                        <div class="mt-4 rounded-full bg-slate-50 p-3 text-xs font-bold text-slate-700">
                                            <span data-preview="location">{{ $value('location') }}</span> · <span data-preview="date">{{ $value('date') }}</span> - <span data-preview="return_date">{{ $value('return_date') }}</span>
                                        </div>
                                    </div>
                                @elseif ($groupName === 'Navigation')
                                    <div class="rounded-2xl bg-white p-4 shadow-sm">
                                        <div class="mb-4 flex items-center gap-1 text-lg font-extrabold"><span class="grid h-6 w-6 place-items-center rounded-full bg-orange-400 text-white">T</span><span data-preview="brand_name">{{ $value('brand_name') }}</span></div>
                                        <div class="grid gap-2 text-sm font-bold">
                                            <span class="rounded-xl bg-orange-50 px-3 py-2 text-orange-500" data-preview="nav_home">{{ $value('nav_home') }}</span>
                                            <span class="rounded-xl bg-slate-50 px-3 py-2" data-preview="nav_tours">{{ $value('nav_tours') }}</span>
                                            <span class="rounded-xl bg-slate-50 px-3 py-2" data-preview="nav_reviews">{{ $value('nav_reviews') }}</span>
                                            <span class="rounded-xl border border-slate-200 px-3 py-2" data-preview="nav_contact">{{ $value('nav_contact') }}</span>
                                        </div>
                                    </div>
                                @elseif ($groupName === 'Values Section')
                                    <div class="rounded-2xl bg-white p-4 shadow-sm">
                                        <p class="text-xs font-extrabold uppercase text-orange-400" data-preview="values_label">{{ $value('values_label') }}</p>
                                        <h3 class="mt-1 text-2xl font-extrabold leading-tight text-slate-950" data-preview="values_title">{{ $value('values_title') }}</h3>
                                        <p class="mt-2 text-xs leading-5 text-slate-500" data-preview="values_text">{{ $value('values_text') }}</p>
                                        <div class="mt-4 grid gap-3">
                                            <div class="rounded-xl bg-slate-50 p-3"><span class="text-2xl">🌍</span><p class="mt-1 font-extrabold" data-preview="choice_title">{{ $value('choice_title') }}</p><p class="text-xs text-slate-500" data-preview="choice_text">{{ $value('choice_text') }}</p></div>
                                            <div class="rounded-xl bg-slate-50 p-3"><span class="text-2xl">🧳</span><p class="mt-1 font-extrabold" data-preview="guide_title">{{ $value('guide_title') }}</p><p class="text-xs text-slate-500" data-preview="guide_text">{{ $value('guide_text') }}</p></div>
                                            <div class="rounded-xl bg-slate-50 p-3"><span class="text-2xl">🎟️</span><p class="mt-1 font-extrabold" data-preview="booking_title">{{ $value('booking_title') }}</p><p class="text-xs text-slate-500" data-preview="booking_text">{{ $value('booking_text') }}</p></div>
                                        </div>
                                    </div>
                                @else
                                    <div class="rounded-2xl bg-white p-4 text-sm text-slate-600 shadow-sm">
                                        <p class="font-extrabold text-slate-900">Decorative elements</p>
                                        <p class="mt-2 leading-6">Field ini mengatur path icon dekoratif seperti kamera dan pesawat pada landing page.</p>
                                        <div class="mt-4 rounded-xl bg-slate-50 p-3 text-xs font-bold text-slate-500">Camera icon & plane icon</div>
                                    </div>
                                @endif
                                </div>
                            </details>

                            <div class="grid gap-3 sm:gap-4 md:grid-cols-2 xl:grid-cols-3">
                                @foreach ($group['keys'] as $key)
                                    @php $item = $contentByKey->get($key); @endphp

                                    @if ($item)
                                        <label class="block rounded-[1.15rem] border border-slate-200 bg-slate-50/70 p-3 transition focus-within:border-orange-300 focus-within:bg-white focus-within:shadow-sm sm:rounded-2xl sm:p-4 {{ in_array($key, ['hero_title', 'values_text', 'choice_text', 'guide_text', 'booking_text'], true) ? 'xl:col-span-2' : '' }}">
                                            <span class="mb-2 flex items-center justify-between gap-2 text-sm font-extrabold text-slate-700">
                                                <span>{{ str($item->content_key)->replace('_', ' ')->title() }}</span>
                                                <small class="rounded-full {{ $item->content_type === 'image' ? 'bg-sky-100 text-sky-700' : 'bg-orange-100 text-orange-700' }} px-2 py-1 text-[10px] uppercase">{{ $item->content_type }}</small>
                                            </span>

                                            @if ($item->content_type === 'image')
                                                <input data-cms-field="{{ $item->content_key }}" name="contents[{{ $item->content_key }}]" value="{{ $value($item->content_key) }}" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-3 text-sm focus:border-orange-400 focus:outline-none" placeholder="/assets/images/example.webp">
                                            @else
                                                <textarea data-cms-field="{{ $item->content_key }}" name="contents[{{ $item->content_key }}]" rows="{{ str($item->content_value)->length() > 55 ? 3 : 2 }}" class="w-full resize-y rounded-xl border border-slate-200 bg-white px-3 py-3 text-sm leading-6 focus:border-orange-400 focus:outline-none">{{ $value($item->content_key) }}</textarea>
                                            @endif
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endforeach

                <div class="sticky bottom-3 z-20 rounded-[1.25rem] border border-slate-200 bg-white/90 p-3 shadow-2xl shadow-slate-300/40 backdrop-blur sm:bottom-4 sm:rounded-[1.5rem]">
                    <div class="grid gap-3 sm:flex sm:items-center sm:justify-between">
                        <p class="text-xs font-bold text-slate-500 sm:text-sm">Pilih section, edit field-nya, lalu simpan semua perubahan sekaligus.</p>
                        <button class="rounded-full bg-orange-400 px-7 py-3 text-sm font-extrabold text-white shadow-lg shadow-orange-200 transition hover:-translate-y-0.5" type="submit">Save Content</button>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <script>
        const sectionTabs = document.querySelectorAll('[data-section-target]');
        const sectionPanels = document.querySelectorAll('[data-section-panel]');

        sectionTabs.forEach((tab) => {
            tab.addEventListener('click', () => {
                const target = tab.dataset.sectionTarget;

                sectionTabs.forEach((item) => {
                    item.classList.remove('bg-orange-400', 'text-white', 'hover:bg-orange-400', 'hover:text-white');
                    item.classList.add('text-slate-700', 'hover:bg-orange-50', 'hover:text-orange-500');
                });

                tab.classList.add('bg-orange-400', 'text-white', 'hover:bg-orange-400', 'hover:text-white');
                tab.classList.remove('text-slate-700', 'hover:bg-orange-50', 'hover:text-orange-500');

                sectionPanels.forEach((panel) => {
                    panel.classList.toggle('hidden', panel.dataset.sectionPanel !== target);
                });
            });
        });

        document.querySelectorAll('[data-cms-field]').forEach((field) => {
            const key = field.dataset.cmsField;
            const updatePreview = () => {
                document.querySelectorAll(`[data-preview="${key}"]`).forEach((preview) => {
                    preview.textContent = field.value || 'Empty content';
                });

                document.querySelectorAll(`[data-preview-src="${key}"]`).forEach((preview) => {
                    preview.src = field.value;
                });
            };

            field.addEventListener('input', updatePreview);
        });
    </script>
</body>
</html>
