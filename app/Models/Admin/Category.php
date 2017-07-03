<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Request;
class Category extends Model
{
    protected $table = 'categorys';
    protected $fillable = ['name', 'parent_id', 'listorder', 'status'];
}
