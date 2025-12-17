<div>
    @foreach ($polls as $poll)
    <div class="mb-4 border-b pb-4">
        @if ($editingPollId === $poll->id)
        <livewire:edit-poll :poll="$poll" :key="$poll->id" />
        @else
        <h3 class="mb-4 text-xl">
            {{ $poll->title }}
        </h3>

        @foreach ($poll->options as $option)
        <div class="mb-2">
            <button class="btn" wire:click="vote({{ $option->id }})">
                Vote
            </button>
            {{ $option->name }} ({{ $option->votes->count() }})
        </div>
        @endforeach

        <div class="mt-4 text-sm text-gray-500">
            <button wire:click="edit({{ $poll->id }})" class="text-blue-500 mr-2">Edit</button>
            <button wire:click="delete({{ $poll->id }})" class="text-red-500">Delete</button>
        </div>
        @endif
    </div>
    @endforeach
</div>