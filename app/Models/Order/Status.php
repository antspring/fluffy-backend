<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'name',
    ];

    const IN_PROGRESS = 1;
    const READY = 2;
    const CANCELED = 3;
}
