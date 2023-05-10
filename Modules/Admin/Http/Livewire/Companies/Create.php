<?php

namespace Modules\Admin\Http\Livewire\Companies;

use App\Models\Company;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;

class   Create extends Component
{
    use WithLaravelFormTrait;

    public $name, $slug, $teaser, $logo = [], $address, $phone, $parent_id, $active = 1;
    protected $rules = [
        'name' => 'string',
        'slug' => 'required|string',
        'teaser' => '',
        'logo' => '',
        'address' => '',
        'phone' => '',
        'parent_id' => '',
        'active' => '',

    ];

    public function mount()
    {
        $this->authorize("admin.companies.create");
        $this->done = 1;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("admin.companies.create");
        $this->validate();
        $data = Company::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'teaser' => $this->teaser,
            'logo' => $this->logo,
            'address' => $this->address,
            'phone' => $this->phone,
            'parent_id' => $this->parent_id,
            'active' => $this->active,

        ]);
        if ($data) {
            $this->redirectForm("admin.companies", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Công ty");
        lForm()->pushBreadcrumb(route("admin"), "Admin");
        lForm()->pushBreadcrumb(route("admin.companies"), "Companies");
        lForm()->pushBreadcrumb(route("admin.companies.create"), "Create");

        return view("admin::livewire.companies.create")
            ->layout('admin::layouts.master', ['title' => 'Companies Create']);
    }
}
