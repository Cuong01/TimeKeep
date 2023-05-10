<?php

namespace Modules\TimeKeep\Views\Components;



use Illuminate\View\Component;

class HeaderBar extends Component
{

    public function render(){

        return view('time-keep::components.header-bar');
    }
}
