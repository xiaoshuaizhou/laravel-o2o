<?php

namespace App\Models\Bis;

use Illuminate\Database\Eloquent\Model;

class Bis extends Model
{
    protected $table = 'biss';
    protected $fillable = ['name', 'city_id', 'city_path', 'logo', 'licence_logo',
            'description', 'bank_info', 'bank_name', 'bank_user', 'faren', 'faren_tel',
            'email'];
}
