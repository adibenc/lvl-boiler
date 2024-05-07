<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BaseComponent extends Component
{
    public $id, $size, $body, $attri="", $class="";
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id = null, $size=4, $body = "")
    {
        $this->setMainAttributes($id, $size, $body);
    }

    public function setMainAttributes($id = null, $size=4, $body = "")
    {
        
        if(!$id){
            $this->id = "box1";
        }else{
            $this->id = $id;
        }
        $this->size = $size;
        $this->body = $body;

        return $this;
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
