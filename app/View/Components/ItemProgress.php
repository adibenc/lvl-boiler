<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ItemProgress extends BaseComponent
{
    public $price, $name, $progress, $target, $percent;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $price="", $progress = 0, $target = "", $id = null, $size=4, $body = "")
    {
        //
        $this->price = $price;
        $this->name = $name;
        $this->target = $target;
        $this->progress = $progress;
        
        $prc = ((int) $progress / (int) $target) * 100;
        $this->percent = is_numeric($prc) ? $prc : 0;
        
        $this->setMainAttributes($id, $size, $body);
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.item-progress');
    }
}
