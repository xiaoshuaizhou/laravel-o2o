<?php

namespace App\Models\Bis;

use Illuminate\Database\Eloquent\Model;

class Featured extends Model
{
    protected $fillable = ['title', 'image', 'type', 'url', 'status', 'listorder', 'description'];

}
