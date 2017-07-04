<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Citys extends Model
{
    protected $table = 'citys';
    protected $fillable = ['name', 'uname', 'listorder', 'parent_id', 'status', 'is_default'];
}
