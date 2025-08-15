<?php

namespace App\Livewire;

use App\Models\Poll;
use App\Models\Vote;
use Livewire\Component;

class Polls extends Component
{
    //cria uma varivel para escutar o evento
    protected $listeners = [
        'pollCreated' => 'render'
    ];
    public function render()
    {
        $polls = Poll::with('options.vote')->latest()->get();
        return view('livewire.polls', ['polls' => $polls]);
    }

    public function vote($id)
    {
        $vote = Vote::create([
            'option_id' => $id,
        ]);
    }
}
