<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    @foreach ($polls as $poll)
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300 relative group">
        @if ($editingPollId === $poll->id)
        <div class="p-6 bg-gray-50 h-full">
            <livewire:edit-poll :poll="$poll" :key="$poll->id" />
        </div>
        @else
        <div class="p-6">
            <div class="flex justify-between items-start mb-6">
                <h3 class="text-xl font-bold text-gray-800 leading-tight">
                    {{ $poll->title }}
                </h3>
                <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <button wire:click="edit({{ $poll->id }})" class="p-1.5 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </button>
                    <button wire:click="delete({{ $poll->id }})"
                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                        class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="space-y-3">
                @foreach ($poll->options as $option)
                <div class="relative group/option cursor-pointer" wire:click="vote({{ $option->id }})">
                    <!-- Progress Bar Background -->
                    @php
                    $totalVotes = $poll->options->sum(fn($o) => $o->votes->count());
                    $percentage = $totalVotes > 0 ? ($option->votes->count() / $totalVotes) * 100 : 0;
                    @endphp
                    <div class="absolute inset-0 bg-indigo-50 rounded-lg transform scale-x-0 origin-left transition-transform duration-500 ease-out"
                        style="width: 100%; --poll-progress: {{ $percentage / 100 }}; transform: scaleX(var(--poll-progress))"></div>

                    <div class="relative flex items-center justify-between p-3 rounded-lg border border-transparent hover:border-indigo-100 transition-colors z-10">
                        <div class="flex items-center gap-3">
                            <div class="h-4 w-4 rounded-full border-2 border-indigo-200 group-hover/option:border-indigo-500 transition-colors"></div>
                            <span class="font-medium text-gray-700 group-hover/option:text-indigo-700 transition-colors">{{ $option->name }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-bold text-indigo-900">{{ $option->votes->count() }}</span>
                            <span class="text-xs text-indigo-400 font-medium tracking-wide">VOTES</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-6 flex justify-end">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    Total Votes: {{ $poll->options->sum(fn($o) => $o->votes->count()) }}
                </span>
            </div>
        </div>
        @endif
    </div>
    @endforeach
</div>