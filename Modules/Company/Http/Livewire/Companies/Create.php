<?php

namespace Modules\Company\Http\Livewire\Companies;

use App\Models\Company;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Str;

class   Create extends Component
{
    use WithFileUploads;
    use WithLaravelFormTrait;

    public $name, $slug, $teaser,  $logo_file, $logo_url, $address, $phone, $parent_id, $active = 1;
    protected $rules = [
        'name' => 'string|required|min:15',
        'slug' => 'string|required|min:15',
        'teaser' => 'string|required|min:15',
        'address' => '',
        'phone' => '',
        'parent_id' => '',
        'active' => '',

    ];

    public function mount()
    {
        $this->authorize("company.companies.create");
        $this->done = 1;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public  function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    public function  updatedLogoFile()
    {
        $this->validate([
            'logo_file' => 'image|max:1024',
        ]);
        if ($this->logo_file) {
            $this->logo_url = $this->logo_file->temporaryUrl();
            list($width, $height) = getimagesize($this->logo_url);
            $this->width = $width;
            $this->height = $height;
        }
    }

    public function store()
    {
        $this->authorize("company.companies.create");
        $this->validate();
        $logo = [];
        if ($this->logo_file) {
            $filename = $this->logo_file->getClientOriginalName();
            $arr = explode(".", $filename);
            $ext = end($arr);

            $data1 = $this->logo_file->storeAs('photos', time() . ".$ext");
            $image = Storage::path($data1);
            list($width, $height) = getimagesize($image);
            $logo = [
                "name" => $data1, "width" => $width, "height" => $height
            ];
            $data = Company::create([
                'name' => $this->name,
                'slug' => $this->slug,
                'teaser' => $this->teaser,
                'logo' => $logo,
                'address' => $this->address,
                'phone' => $this->phone,
                'parent_id' => $this->parent_id,
                'active' => $this->active,

            ]);
        }
        $data = Company::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'teaser' => $this->teaser,
            'address' => $this->address,
            'phone' => $this->phone,
            'parent_id' => $this->parent_id,
            'active' => $this->active,

        ]);
        if ($data) {
            $this->redirectForm("company.companies", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Công ty");
        lForm()->pushBreadcrumb(route("company"), "Company");
        lForm()->pushBreadcrumb(route("company.companies"), "Companies");
        lForm()->pushBreadcrumb(route("company.companies.create"), "Create");

        $companies = Company::all()->pluck('name', 'id');

        return view("company::livewire.companies.create", compact('companies'))
            ->layout('company::layouts.master', ['title' => 'Companies Create']);
    }
}
