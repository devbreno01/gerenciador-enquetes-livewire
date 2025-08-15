<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;

class CreatePoll extends Component
{
    public $title;
    public $options = [''];

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'options' => 'required | min: 1|max:10',
        'options.*' => 'required|min:3|max:255'

    ];

    protected $messages = [
        'options.*' => "A opção não pode estar vázia",
        'title' => "O titulo não pode estar vázio"
    ];
    public function render()
    {
        return view('livewire.create-poll');
    }

    public function addOption()
    {
        $this->options[] = '';

    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);

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
        $this->validate();

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

        //creating a event listener
        $this->dispatch('pollCreated');

    }

    //public function mount()
    //{
    //}


}
