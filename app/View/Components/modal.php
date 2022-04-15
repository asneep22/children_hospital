<?php

namespace App\View\Components;

use Illuminate\View\Component;

class modal extends Component
{
  public $modalId;
  public $modalTitle;
  public $btnClass;
  public $btnText;
  /**
  * Create a new component instance.
  *
  * @return void
  */
  public function __construct($btnClass, $btnText, $modalTitle, $modalId)
  {
    $this->modalId = $modalId;
    $this->modalTitle = $modalTitle;
    $this->btnClass = $btnClass;
    $this->btnText = $btnText;
  }

  /**
  * Get the view / contents that represent the component.
  *
  * @return \Illuminate\Contracts\View\View|\Closure|string
  */
  public function render()
  {
    return view('components.modal');
  }
}
