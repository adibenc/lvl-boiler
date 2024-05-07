<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModalXL extends BaseComponent
{
    public $title, $mfooterjustify;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id = "modal", $size="modal-xl", $body = "", $title="Form", $mfooterjustify=true)
    {
        //
        $this->setMainAttributes($id, $size, $body);
        $this->title = $title;
        $this->mfooterjustify = $mfooterjustify ? true : false;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal-x-l');
    }
}
