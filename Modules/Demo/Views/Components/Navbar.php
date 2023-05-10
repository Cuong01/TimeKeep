<?php

namespace Modules\Demo\Views\Components;

use Illuminate\View\Component;

class Navbar extends Component
{

    public function render()
    {
        $data = config("demo.navbar");

        return view("demo::components.navbar", compact("data"));
    }
}
