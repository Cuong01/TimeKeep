<?php

namespace Modules\TimeKeep\Views\Components;

use Illuminate\View\Component;

class Navbar extends Component
{

    public function render()
    {
        $data = config("timekeep.navbar");

        return view("time-keep::components.navbar", compact("data"));
    }
}
