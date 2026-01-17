<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Busca de Produtos</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
<main class="mx-auto w-full max-w-6xl px-6 py-10">
    <header class="mb-8">
        <h1 class="text-2xl font-semibold text-slate-900">Busca de Produtos</h1>
        <p class="mt-2 text-sm text-slate-600">
            Filtre produtos por nome, categoria e marca. Os filtros são combinados e persistem na URL.
        </p>
    </header>

    <livewire:product-search/>
</main>

@livewireScripts
</body>
</html>
