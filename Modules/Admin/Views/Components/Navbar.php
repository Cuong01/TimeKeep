<?php

namespace Modules\Admin\Views\Components;

use Illuminate\View\Component;

class Navbar extends Component
{

    public function render()
    {
        $data = config("admin.navbar");

        return view("admin::components.navbar", compact("data"));
    }
}
