<?php

namespace Modules\Admin\Http\Livewire\Modules;

use App\Models\Emodule;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;

class   Create extends Component
{
    use WithLaravelFormTrait;

    public $name, $label, $slug, $icon, $permission;
    protected $rules = [
        'name' => 'string',
		'label' => '',
		'slug' => '',
		'icon' => '',
		'permission' => '',
		
    ];

    public function mount()
    {
        $this->authorize("admin.modules.create");
        $this->done = 1;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("admin.modules.create");
        $this->validate();
        $data = Emodule::create([
            'name' => $this->name,
			'label' => $this->label,
			'slug' => $this->slug,
			'icon' => $this->icon,
			'permission' => $this->permission,
			
        ]);
        if ($data) {
            $this->redirectForm("admin.modules", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Modules");
        lForm()->pushBreadcrumb(route("admin"),"Admin");
		lForm()->pushBreadcrumb(route("admin.modules"),"Modules");
		lForm()->pushBreadcrumb(route("admin.modules.create"),"Create");
		
        return view("admin::livewire.modules.create")
            ->layout('admin::layouts.master', ['title' => 'Modules Create']);
    }
}
