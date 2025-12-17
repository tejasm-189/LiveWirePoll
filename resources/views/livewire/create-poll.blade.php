<div>
    <h1>Create a Poll</h1>

    <form wire:submit.prevent="createPoll">
        <label>Poll Title</label>
        <input type="text" wire:model.live="title" placeholder="Poll Title">
        @error('title') <div class="text-red-500">{{ $message }}</div> @enderror

        <div class="mb-4">
            @foreach ($options as $index => $option)
            <div class="mb-4">
                <label>Option {{ $index + 1 }}</label>
                <div class="flex gap-2">
                    <input type="text" wire:model.live="options.{{ $index }}">
                    <button type="button" wire:click="removeOption({{ $index }})">Remove</button>
                </div>
                @error("options.{$index}") <div class="text-red-500">{{ $message }}</div> @enderror
            </div>
            @endforeach
        </div>

        <button type="button" wire:click="addOption">Add Option</button>

        <button type="submit">Create Poll</button>
    </form>

    Current Title: {{ $title }}
</div>