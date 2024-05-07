<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FInput extends FieldComponent
{
    public $number, $name, $type;
    public $vchecked;
    public $btngroup;

    /*
    */
    public function __construct($name, $number="", $type = "text", $id = null, 
        $size=4, $body = "",
        $label = "label",
        $label2 = "-",
        $value = "",
        $placeholder = "0",
        $required = "",
        $attr = "",
        $classApp = "",
        $prepend = false,
        $btngroup = false
        )
    {
        //
        $this->number = $number;
        $this->name = $name;
        $this->type = $type;
        
        $this->label = $label;
        $this->value = $value;
        $this->prepend = $prepend ? $prepend : false;
        $this->btngroup = $btngroup ? $btngroup : false;
        
        $this->setMainAttributes($id, $size, $body);
        $this->setFieldAttributes($label,
            $label2,
            $value,
            $placeholder,
            $required ? "required" : "",
            $classApp,
            $attr
        );
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.f-input');
    }
}
