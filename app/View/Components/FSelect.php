<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FSelect extends FieldComponent
{
    public $number, $name, $type;
    public $vchecked;
    public $datas, $mappedItem;
    public $initPlaceholder;

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
        $datas = [],
        $mappedItem = null,
        $initPlaceholder = "-"
        )
    {
        //
        $this->number = $number;
        $this->name = $name;
        $this->type = $type;
        
        $this->label = $label;
        $this->value = $value;
        $this->datas = $datas;

        $this->mappedItem = $mappedItem ?? function($d){
            return [
                "val" => $d,
                "label" => $d
            ];
        };
        $this->initPlaceholder = $initPlaceholder;
        
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
        return view('components.f-select');
    }
}
