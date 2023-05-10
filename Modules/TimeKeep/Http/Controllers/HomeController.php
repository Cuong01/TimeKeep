<?php

namespace Modules\TimeKeep\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
    {
        lForm()->setTitle('Time Keep');
        lForm()->pushBreadCrumb(route('time-keep'),'Time Keep');

        return view('time-keep::index');
    }
}
