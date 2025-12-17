<?php

namespace App\Livewire;

use App\Models\Poll;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreatePoll extends Component
{
    public $title;
    public $options = ['First'];

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'options' => 'required|array|min:1',
        'options.*' => 'required|min:1|max:255',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addOption()
    {
        $this->options[] = '';
    }

    public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function createPoll()
    {
        $this->validate();

        DB::transaction(function () {
            $poll = Poll::create([
                'title' => $this->title
            ]);

            foreach ($this->options as $optionName) {
                $poll->options()->create(['name' => $optionName]);
            }
        });

        $this->reset(['title', 'options']);

        $this->dispatch('pollCreated');
    }

    public function render()
    {
        return view('livewire.create-poll');
    }
}
