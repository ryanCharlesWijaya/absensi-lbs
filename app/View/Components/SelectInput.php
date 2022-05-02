<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectInput extends Component
{
    public $type;
    public $name;
    public $title;
    public $id;
    public $info;
    public $multiple;
    public $error_name = false;
    public $required = false;
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $title, $id, $info = false, $multiple = false, $error_name = false, $required = false, $value = false)
    {
        $this->name = $name;
        $this->title = $title;
        $this->id = $id;
        $this->info = $info;
        $this->multiple = $multiple;
        $this->error_name = $error_name;
        $this->required = $required;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-input');
    }
}
