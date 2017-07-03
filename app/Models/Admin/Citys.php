<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Overtrue\Pinyin\Pinyin;

class Citys extends Model
{
    protected $table = 'citys';
    protected $fillable = ['name', 'uname', 'listorder', 'parent_id', 'status', 'is_default'];
}
