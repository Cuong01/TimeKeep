<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
    {
        lForm()->setTitle('Admin');
        lForm()->pushBreadCrumb(route('admin'),'Admin');

        return view('admin::index');
    }
}
