<?php

namespace App\Http\Controllers\Bis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index() {
        return view('bis.login.index');
    }
}
