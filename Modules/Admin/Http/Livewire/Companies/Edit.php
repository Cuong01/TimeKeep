<?php

namespace Modules\Admin\Http\Livewire\Companies;

use App\Models\Company;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Edit extends Component
{
    use WithLaravelFormTrait;

    public $name, $slug, $teaser, $logo, $address, $phone, $parent_id, $active = 1;

    protected function rules()
    {
        return [
            'name' => 'string',
            'slug' => 'required|string',
            'teaser' => '',
            'logo' => '',
            'address' => '',
            'phone' => '',
            'parent_id' => '',
            'active' => '',

        ];
    }

    public function mount()
    {
        $this->authorize("admin.companies.edit");
        $data = Company::findOrFail($this->record_id);
        $this->name = $data->name;
        $this->slug = $data->slug;
        $this->teaser = $data->teaser;
        $this->logo = $data->logo;
        $this->address = $data->address;
        $this->phone = $data->phone;
        $this->parent_id = $data->parent_id;
        $this->active = $data->active;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("admin.companies.edit");
        $this->validate();
        $data = Company::findOrFail($this->record_id);
        $data->fill([
            'name' => $this->name,
            'slug' => $this->slug,
            'teaser' => $this->teaser,
            'logo' => $this->logo,
            'address' => $this->address,
            'phone' => $this->phone,
            'parent_id' => $this->parent_id,
            'active' => $this->active,

        ]);
        if (!$data->clean) {
            $data->update();
            $this->redirectForm("admin.companies", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Công ty");
        lForm()->pushBreadcrumb(route("admin"), "Admin");
        lForm()->pushBreadcrumb(route("admin.companies"), "Companies");
        lForm()->pushBreadcrumb(route("admin.companies.edit", $this->record_id), "Edit");

        return view("admin::livewire.companies.edit")
            ->layout('admin::layouts.master', ['title' => 'Companies Edit']);
    }
}
