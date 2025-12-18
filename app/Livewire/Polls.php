<?php

namespace App\Livewire;

use Livewire\Component;

class Polls extends Component
{
    public $editingPollId;

    #[\Livewire\Attributes\On('pollCreated')]
    #[\Livewire\Attributes\On('pollUpdated')]
    #[\Livewire\Attributes\On('pollUpdateCancelled')]
    public function render()
    {
        $polls = \App\Models\Poll::with(['options' => function ($query) {
            $query->withCount('votes');
        }])->latest()->get();

        return view('livewire.polls', ['polls' => $polls]);
    }

    public function vote($optionId)
    {
        $option = \App\Models\Option::findOrFail($optionId);

        $option->votes()->create([
            'poll_id' => $option->poll_id,
        ]);
    }

    public function delete($pollId)
    {
        \App\Models\Poll::findOrFail($pollId)->delete();
        $this->dispatch('notify', message: 'Poll Deleted Successfully!', type: 'success');
    }

    public function edit($pollId)
    {
        $this->editingPollId = $pollId;
    }

    #[\Livewire\Attributes\On('pollUpdated')]
    #[\Livewire\Attributes\On('pollUpdateCancelled')]
    public function cancelEdit()
    {
        $this->editingPollId = null;
    }
}
