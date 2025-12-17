<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LiveWire Poll</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>

<body class="bg-gray-100 min-h-screen font-sans text-gray-900 antialiased">
    <div class="max-w-4xl mx-auto px-4 py-12">
        <h1 class="text-4xl font-extrabold text-center text-indigo-600 mb-10 tracking-tight">
            LiveWire Polls
        </h1>

        <div class="grid gap-10">
            <!-- Create Poll Section -->
            <section>
                <livewire:create-poll />
            </section>

            <hr class="border-gray-300">

            <!-- Polls List Section -->
            <section>
                <livewire:polls />
            </section>
        </div>
    </div>

    @livewireScripts
</body>

</html>