<?php

namespace App\View\Components\Metronic;

use App\View\Components\BaseComponent;
use Illuminate\View\Component;

class Content1 extends BaseComponent
{
    public $title, $mfooterjustify;

	// use breadcumb
	public $usebc;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id = "modal", $size="modal-xl", $body = "", $title="Form", $mfooterjustify=true, $usebc=true)
    {
        //
        $this->setMainAttributes($id, $size, $body);
        $this->title = $title;
        $this->mfooterjustify = $mfooterjustify ? true : false;
        $this->usebc = $usebc ? true : false;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.metronic.content1');
    }
}
