<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CreateTicket extends Component
{
    public $labels;

    public $categories;
    public $agents ;
    public function __construct($labels,$categories,$agents)
    {
        $this->labels = $labels;

        $this->categories = $categories;

        $this->agents = $agents;
    }

    public function render()
    {
        return view('components.create-ticket');
    }
}
