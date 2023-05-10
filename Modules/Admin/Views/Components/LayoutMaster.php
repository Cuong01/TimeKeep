<?php

namespace Modules\Admin\Views\Components;

use Illuminate\View\Component;

class LayoutMaster extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {

        return view('admin::layouts.master');
    }
}
