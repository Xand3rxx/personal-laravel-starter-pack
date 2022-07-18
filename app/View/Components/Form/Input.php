<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Required attributes.
     *
     * @var string
     * @var boolean
     * @var array
     * @var object
     */
    public $type;
    public $name;
    public $placeholder;
    public $disabled;
    public $required;
    public $readonly;
    public $class;
    public $id;
    public $value;

    /**
     * Create the component instance.
     *
     * @param  string  $type
     * @param  string  $name
     * @param  string  $placeholder
     * @param  boolean  $disabled
     * @param  boolean  $required
     * @param  boolean  $readonly
     * @param  string  $class
     * @param  string  $id
     * @param  string  $value
     *
     * @return void
     */
    public function __construct($type, $name, $placeholder = null, $disabled = null, $required = null, $readonly = null, $class, $id, $value)
    {
        $this->type = $type;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->disabled = $disabled;
        $this->$required = $required;
        $this->$readonly = $readonly;
        $this->$class = $class;
        $this->$id = $id;
        $this->$value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.input');
    }
}
