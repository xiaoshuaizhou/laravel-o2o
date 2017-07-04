<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    protected $table = 'categorys';
    protected $fillable = ['name', 'parent_id', 'listorder', 'status'];
}
