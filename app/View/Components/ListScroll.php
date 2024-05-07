<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListScroll extends BaseComponent
{
    public $number, $name, $type, $dataArr;
    public $mappedItem;
    public $header = "", $footer = "";
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, 
        $number="", $type = "bg-success", $id = null, 
        $size=4, $body = "", $dataArr="", $mappedItem = null, $attri="", $class="")
    {
        //
        $this->number = $number;
        $this->name = $name;
        $this->type = $type;
        $this->dataArr = $dataArr;
        $this->attri = $attri;
        $this->class = $class;
        
        $this->setMainAttributes($id, $size, $body);
        $this->mappedItem = $mappedItem ?? function($d){
            $itemData = [
                "name" => "name"
            ];
            return view("cashier.pos.comp-item", $itemData);
        };
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.list-scroll');
    }
}
