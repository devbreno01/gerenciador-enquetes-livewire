<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;

class CreatePoll extends Component
{
    public $title;
    public $options = [''];

    public function render()
    {
        return view('livewire.create-poll');
    }

    public function addOption()
    {
        $this->options[] = '';

    }

    public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);

        /*
         * array_values reorganiza os indices do atributo options.
         * Quando excluimos um indice de um array associativo, ele não reorganiza a numeração dos indeces
         * o array_alue faz isso
         */
    }

    public function createPoll()
    {
        $poll = Poll::create([
            'title' => $this->title
        ])
        ->options()
        ->createMany(
            collect($this->options)
                ->map(fn($option)=> ['name' => $option])
                ->all()
             // Easy to use a foreach for the atribute array
        );

        /*
        foreach ($this->options as $optionName)
        {
            $poll->options()->create([
                'name' => $optionName
            ]);
        }
        */
        $this->reset(['title', 'options']);
    }

    //public function mount()
    //{
    //}


}
