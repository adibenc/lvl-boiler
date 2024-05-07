<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FToogleSwitch extends FieldComponent
{
    public $number, $name, $type;
    public $vchecked;

    public function __construct($name, $number="", $type = "bg-success", $id = null, $size=4, $body = "",
        $label,
        $label2 = "-",
        $value = "", $vchecked = false)
    {
        //
        $this->number = $number;
        $this->name = $name;
        $this->type = $type;
        
        $this->label = $label;
        $this->label2 = $label2;
        $this->value = $value;
        $this->vchecked = $vchecked;
        
        $this->setMainAttributes($id, $size, $body);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.f-toggle-switch');
    }
}
