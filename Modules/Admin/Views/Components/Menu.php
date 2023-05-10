<?php

namespace Modules\Admin\Views\Components;

use Illuminate\View\Component;

class Menu extends Component
{

    public function render()
    {
        $data = config("admin.menu",[]);

        return view("admin::components.menu", compact("data"));
    }
}
