<?php

namespace Modules\Admin\Http\Livewire\Modules;

use App\Models\Emodule;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Edit extends Component
{
    use WithLaravelFormTrait;

    public $name, $label, $slug, $icon, $permission;

    protected function rules()
    {
        return [
            'name' => 'string',
			'label' => '',
			'slug' => '',
			'icon' => '',
			'permission' => '',
			
        ];
    }

    public function mount()
    {
        $this->authorize("admin.modules.edit");
        $data = Emodule::findOrFail($this->record_id);
        $this->name = $data->name;
		$this->label = $data->label;
		$this->slug = $data->slug;
		$this->icon = $data->icon;
		$this->permission = $data->permission;
		
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("admin.modules.edit");
        $this->validate();
        $data = Emodule::findOrFail($this->record_id);
        $data->fill([
            'name' => $this->name,
			'label' => $this->label,
			'slug' => $this->slug,
			'icon' => $this->icon,
			'permission' => $this->permission,
			
        ]);
        if (!$data->clean) {
            $data->update();
            $this->redirectForm("admin.modules", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Modules");
        lForm()->pushBreadcrumb(route("admin"),"Admin");
		lForm()->pushBreadcrumb(route("admin.modules"),"Modules");
		lForm()->pushBreadcrumb(route("admin.modules.edit",$this->record_id),"Edit");

        return view("admin::livewire.modules.edit")
            ->layout('admin::layouts.master', ['title' => 'Modules Edit']);
    }
}
