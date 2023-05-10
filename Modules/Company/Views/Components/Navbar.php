<?php

namespace Modules\Company\Views\Components;

use Illuminate\View\Component;

class Navbar extends Component
{

    public function render()
    {
        $data = config("company.navbar");

        return view("company::components.navbar", compact("data"));
    }
}
