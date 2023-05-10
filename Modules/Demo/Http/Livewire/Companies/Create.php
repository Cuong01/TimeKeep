<?php

namespace Modules\Demo\Http\Livewire\Companies;

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
        $this->authorize("demo.companies.create");
        $this->done = 1;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("demo.companies.create");
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
            $this->redirectForm("demo.companies", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Công ty");
        lForm()->pushBreadcrumb(route("demo"), "Demo");
        lForm()->pushBreadcrumb(route("demo.companies"), "Companies");
        lForm()->pushBreadcrumb(route("demo.companies.create"), "Create");

        return view("demo::livewire.companies.create")
            ->layout('demo::layouts.master', ['title' => 'Companies Create']);
    }
}
