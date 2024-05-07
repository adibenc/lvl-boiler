<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BoxStat extends BaseComponent
{
    public $number, $name, $type;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $number="", $type = "bg-success", $id = null, $size=4, $body = "")
    {
        //
        $this->number = $number;
        $this->name = $name;
        $this->type = $type;
        
        $this->setMainAttributes($id, $size, $body);
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.box-stat');
    }
}
