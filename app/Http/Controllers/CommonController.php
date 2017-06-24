<?php

namespace App\Http\Controllers;

use App\Models\Admin\Citys;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public $city;
    public function __construct(Citys $citys)
    {
        $this->city = $citys;
    }
}
