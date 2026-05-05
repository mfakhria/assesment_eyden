<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assestment Eyden M Fakhri A</title>
    @vite(['resources/js/app.jsx'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@800;900&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script>
        window.pageContent = @json($content);
    </script>
</head>
<body class="min-h-screen overflow-x-hidden bg-[#fbfbff] text-slate-950">
    @if ($databaseOffline ?? false)
        <div class="fixed inset-x-3 top-3 z-50 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm font-bold text-amber-800 shadow-lg shadow-amber-100 sm:left-1/2 sm:right-auto sm:w-fit sm:-translate-x-1/2">
            Database belum terkoneksi. Halaman tetap tampil memakai fallback content.
        </div>
    @endif
    <div id="landing-root"></div>
</body>
</html>
