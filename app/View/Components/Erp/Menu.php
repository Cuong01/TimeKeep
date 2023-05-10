<?php

namespace App\View\Components\Erp;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Nwidart\Modules\Facades\Module;

class Menu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $module;
    public function __construct($module)
    {
        $this->module = $module;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $module = Module::find($this->module);
        $data = [];
        $module_slug = "";
        if($module){
            $data= config($module->getLowerName().".menu",[]);

            $module_slug = Str::slug(Str::headline($module->getName()));
        }

        return view('components.erp.menu',compact("data","module_slug"));
    }
}
