<?php

namespace App\View\Components\Metronic;

use App\View\Components\ModalXL;
use Illuminate\View\Component;

/*
size = mw-900px, modal-lg, modal-xl
*/
class Modal extends ModalXL
{
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
		return view('components.metronic.modal');
	}
}
