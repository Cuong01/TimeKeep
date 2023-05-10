<?php

namespace Modules\Company\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
    {
        lForm()->setTitle('Company');
        lForm()->pushBreadCrumb(route('company'),'Company');

        return view('company::index');
    }
}
