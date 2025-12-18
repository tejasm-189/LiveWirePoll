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

    <div x-data="{
        notifications: [],
        add(message, type = 'success') {
            const id = Date.now();
            this.notifications.push({ id, message, type });
            setTimeout(() => this.remove(id), 3000);
        },
        remove(id) {
            this.notifications = this.notifications.filter(n => n.id !== id);
        }
    }"
        @notify.window="add($event.detail.message, $event.detail.type || 'success')"
        class="fixed bottom-5 right-5 z-50 flex flex-col gap-2">
        <template x-for="notification in notifications" :key="notification.id">
            <div x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform translate-y-2"
                :class="{
                    'bg-green-500': notification.type === 'success',
                    'bg-red-500': notification.type === 'error',
                    'bg-blue-500': notification.type === 'info'
                 }"
                class="text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-3 min-w-[300px]">

                <!-- Success Icon -->
                <svg x-show="notification.type === 'success'" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>

                <!-- Error Icon -->
                <svg x-show="notification.type === 'error'" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>

                <span x-text="notification.message" class="font-medium"></span>
            </div>
        </template>
    </div>

    @livewireScripts
</body>

</html>