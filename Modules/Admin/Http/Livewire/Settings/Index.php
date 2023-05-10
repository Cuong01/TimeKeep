<?php
namespace Modules\Admin\Http\Livewire\Settings;
use Livewire\Component;

class Index extends Component
{

    public function render(){
        lForm()->setTitle("Setting");
        lForm()->pushBreadCrumb(route("admin"),"Admin");
        lForm()->pushBreadCrumb(route("admin.settings"),"Setting");

        return view("admin::livewire.settings.index")
            ->layout('admin::layouts.master', ['title' => 'Setting']);
    }
}
