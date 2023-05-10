<?php

namespace Modules\Demo\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
    {
        lForm()->setTitle('Demo');
        lForm()->pushBreadCrumb(route('demo'),'Demo');

        return view('demo::index');
    }
}
