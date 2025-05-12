<?php

namespace App\Livewire;

use Livewire\Component;
use PhpParser\Node\Expr\FuncCall;

class Dashboard extends Component
{
    public $count = 0;

    public function increment()
    {
        $this->count++;
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
