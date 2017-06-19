<?php

namespace App\Http\Controllers\Bis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index() {
        return view('bis.index.index');
    }
}
