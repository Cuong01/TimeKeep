<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ErpLayout extends Component
{
    public $title;
    public $module;
    public $assets;
    public function __construct($module="",$title="",$assets="")
    {
        $this->module = $module;
        $this->title = $title;

    }
    public function render()
    {
        return view('layouts.erp',[
            "module"=>$this->module
            ,"title"=>$this->title
            ,"assets"=>$this->assets
        ]);
    }
}
