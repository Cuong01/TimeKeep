<?php

namespace Modules\Admin\Http\Livewire\Permissions;

use App\Models\Permission;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Edit extends Component
{
    use WithLaravelFormTrait;

    public $name, $label, $parent_id, $module, $type;

    protected function rules()
    {
        return [
            'name' => 'string|required',
            'label' => 'string|required',
            'type' => 'string|required|in:module,page,method',
            "module"=> "string|required"
        ];
    }

    public function mount()
    {
        $this->authorize("admin.permissions.edit");
        $data = Permission::findOrFail($this->record_id);
        $this->name = $data->name;
		$this->label = $data->label;
		$this->parent_id = $data->parent_id;
		$this->module = $data->module;
		$this->type = $data->type;

    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("admin.permissions.edit");
        $this->validate();
        $data = Permission::findOrFail($this->record_id);
        $data->fill([
            'name' => $this->name,
			'label' => $this->label,
			'parent_id' => $this->parent_id,
			'module' => $this->module,
			'type' => $this->type,

        ]);
        if (!$data->clean) {
            $data->update();
            $this->redirectForm("admin.permissions", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Permissions");
        lForm()->pushBreadcrumb(route("admin"),"Admin");
		lForm()->pushBreadcrumb(route("admin.permissions"),"Admin");
		lForm()->pushBreadcrumb(route("admin.permissions.edit",$this->record_id),"Edit");

        $parents = Permission::whereModule($this->module)->whereType('page')->get()->pluck("label","id");

        return view("admin::livewire.permissions.edit",compact("parents"))
            ->layout('admin::layouts.master', ['title' => 'Permissions Edit']);
    }
}
