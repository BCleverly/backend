<?php

namespace BCleverly\Backend\Views\Components;

use BCleverly\Backend\Models\Festival\FestivalDay;
use Illuminate\View\Component;

class ManagePerformers extends Component
{
    public $days;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public FestivalDay $festival)
    {
        $this->days = $festival->performers->groupBy([
            'pivot.day',
            'pivot.stage_name',
        ])->sortBy('pivot.time');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('backend::festival.manage-performers');
    }
}
