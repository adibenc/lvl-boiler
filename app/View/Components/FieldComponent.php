<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FieldComponent extends BaseComponent
{
    public $number, $name, $type;
    public $label, $label2, $value;
    public $placeholder, $required, $classApp, $attr;
    public $prepend;

	// public $colSize = "col-lg-4";
	public $colSize = "";
	
	public $useFormGroup = true;
	// public $useFormGroup = false;
	
	public $exclamation = false;
	
	public $classp = "";
	public $exch = "";

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $number="", $type = "text", 
        $id = null, $size=4, $body = "",
        $label,
        $label2 = "-",
        $value = "",
        $placeholder = "",
        $required = "false",
        $classApp = "false",
        $attr = ""
        )
    {
        //
        $this->number = $number;
        $this->name = $name;
        $this->type = $type;
        
        $this->setMainAttributes($id, $size, $body);
    }

    public function setFieldAttributes($label,
        $label2,
        $value,
        $placeholder,
        $required,
        $classApp,
        $attr){

        $this->label = $label;
        $this->label2 = $label2;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->classApp = $classApp;
        $this->attr = $attr;

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
