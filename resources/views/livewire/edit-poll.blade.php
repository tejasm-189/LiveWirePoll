<div>
    <div class="mb-4 p-4 border rounded">
        <h3 class="mb-2 text-lg font-bold">Edit Poll</h3>

        <form wire:submit.prevent="update">
            <div class="mb-2">
                <label>Poll Title</label>
                <input type="text" wire:model.live="title" class="border p-1 w-full">
                @error('title') <div class="text-red-500">{{ $message }}</div> @enderror
            </div>

            <div class="mb-2">
                <label>Options</label>
                @foreach ($options as $index => $option)
                <div class="flex gap-2 mb-2">
                    <input type="text" wire:model.live="options.{{ $index }}.name" class="border p-1 flex-1">
                    <button type="button" class="text-red-500" wire:click="removeOption({{ $index }})">X</button>
                </div>
                @error("options.{$index}.name") <div class="text-red-500">{{ $message }}</div> @enderror
                @endforeach
            </div>

            <button type="button" wire:click="addOption" class="mb-2 text-blue-500">+ Add Option</button>

            <div class="flex gap-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Save</button>
                <button type="button" wire:click="$dispatch('pollUpdateCancelled')" class="border px-4 py-1 rounded">Cancel</button>
            </div>
        </form>
    </div>
</div>