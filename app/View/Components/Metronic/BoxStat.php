<?php

namespace App\View\Components\Metronic;

use App\View\Components\BoxStat as ComponentsBoxStat;
use Illuminate\View\Component;

class BoxStat extends ComponentsBoxStat
{
    public $number, $name, $type, $numClass;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $number="", 
		$type = "bg-success", $id = null, $size=4, $body = "",
		$numClass="fs-2hx fw-bold text-gray-800 me-2 lh-1")
    {
        //
        $this->number = $number;
        $this->name = $name;
        $this->type = $type;
        $this->numClass = $numClass;
        
        $this->setMainAttributes($id, $size, $body);
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.metronic.box-stat');
    }
}
