<?php

namespace App\View\Components;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\View\Component;

class Tabs extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
       
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tabs');
    }
}
