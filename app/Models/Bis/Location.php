<?php

namespace App\Models\Bis;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['bis_id', 'logo', 'name', 'contact', 'category_id', 'category_path', 'city_id', 'city_path', 'address', 'open_time', 'content', 'api_address', 'is_main', 'xpoint', 'ypoint', 'bank_info'];

}
