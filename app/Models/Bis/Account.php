<?php

namespace App\Models\Bis;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['bis_id', 'username', 'status', 'password',
            'last_login_ip', 'last_login_time', 'is_man'];
}
