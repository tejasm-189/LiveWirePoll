<div class="bg-white rounded-2xl shadow-xl p-8 transform transition hover:scale-[1.01] duration-300">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Create a New Poll
    </h2>

    <form wire:submit.prevent="createPoll" class="space-y-6">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Poll Title</label>
            <input type="text" wire:model.live="title" placeholder="e.g., What's your favorite framework?"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all text-gray-700 placeholder-gray-400">
            @error('title') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="space-y-4">
            <label class="block text-sm font-semibold text-gray-700">Options</label>
            @foreach ($options as $index => $option)
            <div class="flex items-center gap-3 animate-fade-in-down">
                <span class="text-gray-400 font-mono text-sm w-6">{{ $index + 1 }}.</span>
                <div class="flex-1 relative">
                    <input type="text" wire:model.live="options.{{ $index }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all">
                </div>
                <button type="button" wire:click="removeOption({{ $index }})"
                    class="p-2 text-gray-400 hover:text-red-500 transition-colors rounded-full hover:bg-red-50" title="Remove Option">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            @error("options.{$index}") <span class="text-red-500 text-sm ml-9 block">{{ $message }}</span> @enderror
            @endforeach
        </div>

        <div class="flex items-center justify-between pt-4">
            <button type="button" wire:click="addOption"
                class="flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Another Option
            </button>

            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:shadow-indigo-500/30 transform hover:-translate-y-0.5 transition-all duration-200">
                Create Poll
            </button>
        </div>
    </form>
</div>