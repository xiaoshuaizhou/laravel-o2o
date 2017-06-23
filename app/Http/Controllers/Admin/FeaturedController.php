<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeaturedController extends Controller
{
    public function index()
    {
        return view('admin.featured.index');
    }

    public function add()
    {
        $featureds = config('app.featured');
        return view('admin.featured.add', compact('featureds'));
    }
}
