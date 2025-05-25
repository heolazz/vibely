<?php 
namespace App\View\Components;

use Illuminate\View\Component;

class Icon extends Component
{
    public string $name;

    /**
     * Create a new component instance.
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.icon');
    }
}
