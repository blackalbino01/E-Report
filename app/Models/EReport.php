<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class EReport extends Eloquent
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'state_code',
        'subject',
        'report'
    ];
}