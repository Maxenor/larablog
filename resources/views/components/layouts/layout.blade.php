<!doctype html>

<title>
    {{ $title ?? 'Laravel From Scratch' }}
</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


<body style="font-family: Open Sans, sans-serif">
<section class="px-6 py-8">

    <x-layouts.navigation/>


    {{ $slot }}

    <x-layouts.footer/>
</section>
</body>
