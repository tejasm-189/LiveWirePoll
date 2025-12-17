<?php

namespace App\Livewire;

use Livewire\Component;

class EditPoll extends Component
{
    public $pollId;
    public $title;
    public $options;

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'options' => 'required|array|min:1',
        'options.*.name' => 'required|min:1|max:255',
    ];

    public function mount(\App\Models\Poll $poll)
    {
        $this->pollId = $poll->id;
        $this->title = $poll->title;
        $this->options = $poll->options->map(function ($option) {
            return ['id' => $option->id, 'name' => $option->name];
        })->toArray();
    }

    public function addOption()
    {
        $this->options[] = ['id' => null, 'name' => ''];
    }

    public function removeOption($index)
    {
        $option = $this->options[$index];
        if ($option['id']) {
            \App\Models\Option::find($option['id'])?->delete();
        }

        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function update()
    {
        $this->validate();

        $poll = \App\Models\Poll::findOrFail($this->pollId);
        $poll->update(['title' => $this->title]);

        foreach ($this->options as $optionData) {
            if ($optionData['id']) {
                $poll->options()->where('id', $optionData['id'])->update(['name' => $optionData['name']]);
            } else {
                $poll->options()->create(['name' => $optionData['name']]);
            }
        }

        $this->dispatch('pollUpdated');
    }

    public function render()
    {
        return view('livewire.edit-poll');
    }
}
