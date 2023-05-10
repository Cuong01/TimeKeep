<?php

namespace App\Traits;

use App\Models\CompanyModule;
use App\Models\Emodule;

trait AccessModuleTraits
{

    public function hasAccessModule($name){
        return $this->emodules->contains("name",$name);
        //return $this->emodules()->where("emodules.name",$name)->first();
    }
    public function emodules(){
        return $this->hasManyThrough(Emodule::class,CompanyModule::class,"company_id","id","company_id","module_id");
    }
    public function getAllModules(){

    }

}
