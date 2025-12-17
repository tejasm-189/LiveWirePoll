<div>
    <div class="space-y-6">
        <div class="flex items-center justify-between pb-4 border-b border-gray-100">
            <h3 class="text-xl font-bold text-gray-800">Edit Poll</h3>
            <button wire:click="$dispatch('pollUpdateCancelled')" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form wire:submit.prevent="update" class="space-y-5">
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Poll Title</label>
                <input type="text" wire:model.live="title"
                    class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all text-gray-800 font-semibold">
                @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-3">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide">Options</label>
                @foreach ($options as $index => $option)
                <div class="flex items-center gap-2">
                    <div class="flex-1">
                        <input type="text" wire:model.live="options.{{ $index }}.name"
                            class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all text-sm">
                    </div>
                    <button type="button" wire:click="removeOption({{ $index }})"
                        class="p-2 text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                @error("options.{$index}.name") <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
                @endforeach
            </div>

            <button type="button" wire:click="addOption"
                class="w-full py-2 border-2 border-dashed border-gray-200 rounded-lg text-sm font-medium text-gray-400 hover:text-indigo-600 hover:border-indigo-200 hover:bg-indigo-50 transition-all flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Option
            </button>

            <div class="flex gap-3 pt-2">
                <button type="button" wire:click="$dispatch('pollUpdateCancelled')"
                    class="flex-1 px-4 py-2 border border-gray-200 rounded-lg text-gray-600 text-sm font-medium hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <button type="submit"
                    class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium shadow-md hover:bg-indigo-700 transition-all">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>