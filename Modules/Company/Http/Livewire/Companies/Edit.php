<?php

namespace Modules\Company\Http\Livewire\Companies;

use App\Models\Company;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Str;



class Edit extends Component
{
    use WithFileUploads;
    use WithLaravelFormTrait;

    public $name, $slug, $teaser, $logo_file, $logo_url, $address, $phone, $parent_id, $active = 1;

    protected function rules()
    {
        return [
            'name' => 'string|required|min:15',
            'slug' => 'string|required|min:15',
            'teaser' => 'string|required|min:15',
            'address' => '',
            'phone' => '',
            'parent_id' => '',
            'active' => '',

        ];
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

    public function mount()
    {
        $this->authorize("company.companies.edit");
        $data = Company::findOrFail($this->record_id);
        $this->name = $data->name;
        $this->slug = $data->slug;
        $this->teaser = $data->teaser;
        $this->address = $data->address;
        $this->phone = $data->phone;
        $this->parent_id = $data->parent_id;
        $this->active = $data->active;
        if ($data->logo) {
            $this->logo_file = $data->logo->name;
            $this->logo_url = "/" . $data->logo->name;
            $this->width = $data->logo->width;
            $this->height = $data->logo->height;
        }
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $data = Company::findOrFail($this->record_id);
        $this->authorize("company.companies.edit");
        $this->validate();
        if ($data->logo) {
            if ($data->logo->name != $this->logo_file) {
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
                }
                $data->fill([
                    'name' => $this->name,
                    'slug' => $this->slug,
                    'teaser' => $this->teaser,
                    'logo' => $logo,
                    'address' => $this->address,
                    'phone' => $this->phone,
                    'parent_id' => $this->parent_id,
                    'active' => $this->active,

                ]);
            } else {
                $data->fill([
                    'name' => $this->name,
                    'slug' => $this->slug,
                    'teaser' => $this->teaser,
                    'address' => $this->address,
                    'phone' => $this->phone,
                    'parent_id' => $this->parent_id,
                    'active' => $this->active,

                ]);
            }
        } else {
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
                $data->fill([
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
            $data->fill([
                'name' => $this->name,
                'slug' => $this->slug,
                'teaser' => $this->teaser,
                'address' => $this->address,
                'phone' => $this->phone,
                'parent_id' => $this->parent_id,
                'active' => $this->active,

            ]);
        }
        if (!$data->clean) {
            $data->update();
            $this->redirectForm("company.companies", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Công ty");
        lForm()->pushBreadcrumb(route("company"), "Company");
        lForm()->pushBreadcrumb(route("company.companies"), "Companies");
        lForm()->pushBreadcrumb(route("company.companies.edit", $this->record_id), "Edit");

        $companies = Company::all()->pluck('name', 'id');

        return view("company::livewire.companies.edit", compact('companies'))
            ->layout('company::layouts.master', ['title' => 'Companies Edit']);
    }
}
