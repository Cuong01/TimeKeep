<?php

namespace Modules\Demo\Views\Components;



use Illuminate\View\Component;

class HeaderBar extends Component
{

    public function render(){

        return view('demo::components.header-bar');
    }
}
