<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SidebarMenu extends BaseComponent
{
    public $number, $name, $type, $title, $href;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $href, $name="", $number="", $type = "bg-success", $id = null, $size=4, $body = "", $icon="")
    {
        //
        $this->number = $number;
        $this->name = $name;
        $this->type = $type;
        $this->title = $title;
        $this->href = $href;
        
        $this->setMainAttributes($id, $size, $body);
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar-menu');
    }
}
